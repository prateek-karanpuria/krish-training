<?php
/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
namespace RB\MultiCoupons\Model\Rewrite\Quote;

class Discount extends \Magento\SalesRule\Model\Quote\Discount
{
    /**
     * Description of Discount
     *
     * @author Rocket Bazaar Core Team
     */
    protected $calculator;

    /**
     * Core event manager proxy
     *
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager = null;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $priceCurrency;

    /**
     * Multiple Coupon Helper
     *
     * @var \RB\MultiCoupons\Helper\Data
     */
    protected $multiCouponHelper;

    /**
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\SalesRule\Model\Validator $validator
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     */
    public function __construct(
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\SalesRule\Model\Validator $validator,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \RB\MultiCoupons\Helper\Data $multiCouponHelper
    ) {
        $this->setCode('discount');
        parent::__construct(
            $eventManager,
            $storeManager,
            $validator,
            $priceCurrency
        );
        $this->eventManager = $eventManager;
        $this->calculator = $validator;
        $this->storeManager = $storeManager;
        $this->priceCurrency = $priceCurrency;
        $this->multiCouponHelper = $multiCouponHelper;
    }
    /**
     * Collect address discount amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        $storeId = $this->storeManager->getStore()->getId();
        if(!$this->multiCouponHelper->isEnabled($storeId)) {
            return parent::collect($quote, $shippingAssignment, $total);
        }
        $store = $this->storeManager->getStore($quote->getStoreId());
        $address = $shippingAssignment->getShipping()->getAddress();
        $this->calculator->reset($address);
        
        // Get coupon codes from quote object. The value will be comma separated string
        $couponCode = $quote->getCouponCode();

        // Convert coupon codes into array
        $couponCodes = array_unique(explode(',',$couponCode));
        $discountAmount = $baseDiscountAmount = 0;

        // Temp variable
        $discountTotalTemp = [];

        // Get all cart items
        $items = $shippingAssignment->getItems();
        if (!count($items)) {
            return $this;
        }
        // Loop through each coupon code
        foreach($couponCodes as $couponCode){
            $couponCode = trim($couponCode);
            $eventArgs = [
                'website_id' => $store->getWebsiteId(),
                'customer_group_id' => $quote->getCustomerGroupId(),
                'coupon_code' => $couponCode,
            ];
            
            $this->calculator->init($store->getWebsiteId(), $quote->getCustomerGroupId(), $couponCode);
            $this->calculator->initTotals($items, $address);

            $address->setDiscountDescription([$couponCode]);
            $items = $this->calculator->sortItemsByPriority($items, $address);
            
            /** @var \Magento\Quote\Model\Quote\Item $item */
            foreach ($items as $item) {
                $vendorId = $item->getVendorId();
                if ($item->getNoDiscount() || !$this->calculator->canApplyDiscount($item)) {
                    $item->setDiscountAmount(0);
                    $item->setBaseDiscountAmount(0);

                    // ensure my children are zeroed out
                    if ($item->getHasChildren() && $item->isChildrenCalculated()) {
                        foreach ($item->getChildren() as $child) {
                            $child->setDiscountAmount(0);
                            $child->setBaseDiscountAmount(0);
                        }
                    }
                    continue;
                }
                // to determine the child item discount, we calculate the parent
                if ($item->getParentItem()) {
                    continue;
                }

                $eventArgs['item'] = $item;
                $this->eventManager->dispatch('sales_quote_address_discount_item', $eventArgs);
                
                if ($item->getHasChildren() && $item->isChildrenCalculated()) {
                    $this->calculator->process($item);
                    $this->distributeDiscount($item);
                    foreach ($item->getChildren() as $child) {
                        $eventArgs['item'] = $child;
                        $this->eventManager->dispatch('sales_quote_address_discount_item', $eventArgs);
                        $this->aggregateItemDiscount($child, $total);
                    }
                } else {
                    $this->calculator->process($item);
                    $this->aggregateItemDiscount($item, $total);
                }
                
                // Get total discount for each item
                if(isset($discountTotalTemp[$item->getId()])){
                    $discountTotalTemp[$item->getId()] += $item->getDiscountAmount();
                }else{
                    $discountTotalTemp[$item->getId()] = $item->getDiscountAmount();
                }
                
                // Check for Maximum allowed discount per item
                $rowTotal = $item->getRowTotal();
                $maxDiscount = min($rowTotal, $discountTotalTemp[$item->getId()]);
                
                // Set total discount for each item
                $item->setDiscountAmount($maxDiscount);
                $item->setBaseDiscountAmount($maxDiscount);
                
            }

            // Store already applied rules
            $address->setAppliedMultipleRules($address->getAppliedRuleIds());
        }
        $address->setShippingDiscountAmount(0);
        $address->setBaseShippingDiscountAmount(0);
        $address->setAppliedMultipleRules('');
        if ($address->getShippingAmount()) {
            $this->calculator->processShippingAmount($address);
            $total->addTotalAmount($this->getCode(), -$address->getShippingDiscountAmount());
            $total->addBaseTotalAmount($this->getCode(), -$address->getBaseShippingDiscountAmount());
            $total->setShippingDiscountAmount($address->getShippingDiscountAmount());
            $total->setBaseShippingDiscountAmount($address->getBaseShippingDiscountAmount());
        }

        $getDiscountAmount = $total->getDiscountAmount();
        $getBaseDiscountAmount = $total->getBaseDiscountAmount();
        $getSubtotal = $total->getSubtotal();
        $getBaseSubtotal = $total->getBaseSubtotal();

        // Check for discount amount exceeds subtotal, if exceeds, set discount amount to subtotal amount
        if(-$getDiscountAmount > $getSubtotal) { $getDiscountAmount = -$getSubtotal; }
        if(-$getBaseDiscountAmount > $getBaseSubtotal) { $getBaseDiscountAmount = -$getBaseSubtotal; }

        $this->calculator->prepareDescription($address);

        // Set discount details
        $total->setDiscountDescription($address->getDiscountDescription());
        $total->setTotalAmount($this->getCode(), $getDiscountAmount);
        $total->setBaseTotalAmount($this->getCode(), $getBaseDiscountAmount);
        $total->setDiscountAmount($getDiscountAmount);
        $total->setBaseDiscountAmount($getBaseDiscountAmount);

        // Set subtotal details
        $total->setSubtotalWithDiscount($total->getSubtotal() + $getDiscountAmount);
        $total->setBaseSubtotalWithDiscount($total->getBaseSubtotal() + $getBaseDiscountAmount);
        return $this;
    }
}
