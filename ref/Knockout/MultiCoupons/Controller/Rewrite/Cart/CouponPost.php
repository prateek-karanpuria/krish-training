<?php
/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
namespace RB\MultiCoupons\Controller\Rewrite\Cart;

/**
 * Description of CouponPost
 *
 * @author Rocket Bazaar Core Team
 */

class CouponPost extends \Magento\Checkout\Controller\Cart\CouponPost
{
    /**
     * Sales quote repository
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Coupon factory
     *
     * @var \Magento\SalesRule\Model\CouponFactory
     */
    protected $couponFactory;

    /**
     * Multiple Coupon Helper
     *
     * @var \RB\MultiCoupons\Helper\Data
     */
    protected $multiCouponHelper;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Checkout\Model\Cart $cart
     * @param \Magento\SalesRule\Model\CouponFactory $couponFactory
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\SalesRule\Model\CouponFactory $couponFactory,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \RB\MultiCoupons\Helper\Data $multiCouponHelper
    ) {
        parent::__construct(
            $context,
            $scopeConfig,
            $checkoutSession,
            $storeManager,
            $formKeyValidator,
            $cart,
            $couponFactory,
            $quoteRepository
        );
        $this->couponFactory = $couponFactory;
        $this->quoteRepository = $quoteRepository;
        $this->multiCouponHelper = $multiCouponHelper;
    }
    /**
     * Initialize coupon
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $storeId = $this->_storeManager->getStore()->getId();
        if(!$this->multiCouponHelper->isEnabled($storeId)) {
            return parent::execute();
        }
        $couponCode = $this->getRequest()->getParam('remove') == 1
            ? ''
            : trim($this->getRequest()->getParam('coupon_code'));
        $cartQuote = $this->cart->getQuote();
        $appliedCoupons = $invalidCoupons = $result = $oldCouponCodes = $removedCoupon = [];

        // Get old Coupon codes
        $oldCouponCode = $cartQuote->getCouponCode();
        $oldCouponCodes = ($cartQuote->getCouponCode()) ? explode(",",$cartQuote->getCouponCode()) : [];
        $result['invalid'] = false;

        // Get current coupon codes. All applied coupon codes will be joined using (,)
        // Explode to convert in array
        $couponCodes = array_unique(explode(",",$couponCode));

        $codeLength = strlen(trim($couponCode));
        if (!$codeLength && !strlen($oldCouponCode)) {
            return $this->_goBack();
        }

        try {
            $isCodeLengthValid = $codeLength && $codeLength <= \Magento\Checkout\Helper\Cart::COUPON_CODE_MAX_LENGTH;

            $itemsCount = $cartQuote->getItemsCount();
            if ($itemsCount) {
                $cartQuote->getShippingAddress()->setCollectShippingRates(true);

                // Pass all coupon code as comma separated value
                $cartQuote->setCouponCode($isCodeLengthValid ? $couponCode : '')->collectTotals();
                $this->quoteRepository->save($cartQuote);
            }

            if ($codeLength) {
                $escaper = $this->_objectManager->get(\Magento\Framework\Escaper::class);

                // Loop through all coupon codes to check for valid and invalid coupon codes.
                foreach($couponCodes as $couponCode){
                    $coupon = $this->couponFactory->create();
                    $coupon->load($couponCode, 'code');

                    if ($isCodeLengthValid && $coupon->getId() && in_array($coupon->getRuleId(),explode(",",$cartQuote->getShippingAddress()->getAppliedRuleIds()))) {
                        $appliedCoupons[] = $couponCode;
                    } else {
                        $invalidCoupons[] = $couponCode;
                        $result['invalid'] = true;
                    }
                }

                // Get removed Coupon code.
                $removedCoupon = array_diff($oldCouponCodes,$appliedCoupons);

                // Prepare message to display to user
                if(count($appliedCoupons)){
                    if((empty($removedCoupon) || empty($oldCouponCodes)) && array_diff($appliedCoupons, $oldCouponCodes)){
                        $this->messageManager->addSuccess(
                            __(
                                'You used coupon code "%1".',
                                $escaper->escapeHtml(implode(", ",$appliedCoupons))
                            )
                        );
                    }
                    else if(!empty($removedCoupon)){
                        $this->messageManager->addSuccess(
                            __(
                                'You removed coupon code "%1".',
                                $escaper->escapeHtml(implode(", ",$removedCoupon))
                            )
                        );
                    }
                    $result['applied_coupons'] = implode(",",$appliedCoupons);
                }

                // Invalid Coupons
                if($result['invalid']){
                    $this->messageManager->addError(
                        __(
                            'The coupon code "%1" is not valid.',
                            $escaper->escapeHtml(implode(", ",$invalidCoupons))
                        )
                    );
                }
            } else {
                $this->messageManager->addSuccess(__('You canceled the coupon code(s).'));
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addError(__('We cannot apply the coupon code.'));
            $this->_objectManager->get(\Psr\Log\LoggerInterface::class)->critical($e);
        }

        // Apply all valid coupons to current cart
        $cartQuote->getShippingAddress()->setCollectShippingRates(true);
        $cartQuote->setCouponCode($isCodeLengthValid ? implode(",",$appliedCoupons) : '')->collectTotals();
        $this->quoteRepository->save($cartQuote);

        // Return json object $result
        $this->getResponse()->representJson(
            $this->_objectManager->get(\Magento\Framework\Json\Helper\Data::class)->jsonEncode($result)
        );
    }
}
