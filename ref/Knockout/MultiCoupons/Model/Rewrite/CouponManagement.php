<?php
/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */

namespace RB\MultiCoupons\Model\Rewrite;

use \Magento\Quote\Api\CouponManagementInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Coupon management object.
 */
class CouponManagement extends \Magento\Quote\Model\CouponManagement implements CouponManagementInterface
{
    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Multiple Coupon Helper
     *
     * @var \RB\MultiCoupons\Helper\Data
     */
    protected $multiCouponHelper;

    /**
     * Constructs a coupon read service object.
     *
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository Quote repository.
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \RB\MultiCoupons\Helper\Data $multiCouponHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\SalesRule\Model\CouponFactory $couponFactory,
        \Magento\Framework\Json\Helper\Data $json
    ) {
        parent::__construct(
            $quoteRepository
        );
        $this->quoteRepository = $quoteRepository;
        $this->_storeManager = $storeManager;
        $this->couponFactory = $couponFactory;
        $this->json = $json;
        $this->multiCouponHelper = $multiCouponHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function set($cartId, $couponCode)
    {
        /* Check if Module Enabled */
        $storeId = $this->_storeManager->getStore()->getId();
        if(!$this->multiCouponHelper->isEnabled($storeId)) {
            return parent::set($cartId, $couponCode);
        }
        
        $appliedCoupons = $invalidCoupons = $result = $oldCouponCodes = $removedCoupon = [];
        $quote = $this->quoteRepository->getActive($cartId);
        $couponCodes = array_unique(explode(",",$couponCode));
        $oldCouponCodes = ($quote->getCouponCode()) ? explode(",",$quote->getCouponCode()) : [];
        
        /** @var  \Magento\Quote\Model\Quote $quote */
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $quote->getShippingAddress()->setCollectShippingRates(true);

        try {
            $quote->setCouponCode($couponCode);
            $this->quoteRepository->save($quote->collectTotals());
            
            // Loop through all coupon codes to check for valid and invalid coupon codes.
            foreach($couponCodes as $couponCode){
                $couponCode = trim($couponCode);
                $coupon = $this->couponFactory->create();
                $coupon->load($couponCode, 'code');

                if ($coupon->getId() && in_array($coupon->getRuleId(),explode(",",$quote->getShippingAddress()->getAppliedRuleIds()))) {
                    $appliedCoupons[] = $couponCode;
                } else {
                    $invalidCoupons[] = $couponCode;
                    $result['invalid'] = true;
                }
            }

            $removedCoupon = array_diff($oldCouponCodes,$appliedCoupons);
            $quote->getShippingAddress()->setCollectShippingRates(true);
            $quote->setCouponCode(implode(",",$appliedCoupons));
            $this->quoteRepository->save($quote->collectTotals());
            $result['applied'] = implode(",",$appliedCoupons);
            $result['invalid'] = implode(",",$invalidCoupons);
            $result['removed'] = implode(",",$removedCoupon);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not apply coupon code'));
        }
        /*if ($quote->getCouponCode() != $couponCode) {
            throw new NoSuchEntityException(__('Coupon code is not valid'));
        }*/
        // return true;
        return $this->json->jsonEncode($result);
    }
}