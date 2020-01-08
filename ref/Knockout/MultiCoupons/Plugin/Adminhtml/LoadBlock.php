<?php
/*
 * Copyright © 2016 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
namespace RB\MultiCoupons\Plugin\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\ForwardFactory;

/**
 * Description of LoadBlock Plugin
 *
 * @author Rocket Bazaar Core Team
 */

class LoadBlock
{
    protected $multiCouponHelper;
    protected $escaper;
    protected $messageManager;
    protected $quote;
 
    public function __construct(
        \RB\MultiCoupons\Helper\Data $multiCouponHelper,
        \Magento\Framework\Escaper $escaper,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Backend\Model\Session\Quote $quote
    ) {
        $this->multiCouponHelper = $multiCouponHelper;
        $this->escaper = $escaper;
        $this->messageManager = $messageManager;
        $this->quote = $quote;
    }

    public function aroundExecute(\Magento\Sales\Controller\Adminhtml\Order\Create\LoadBlock $subject, callable $proceed){
        $returnValue = $proceed();
        
        if ($returnValue) {
            if(!$this->multiCouponHelper->isEnabled()) {
                return $returnValue;
            }
            $cartObject = $this->quote->getQuote();

            $cartObject->collectTotals();
            $data = $subject->getRequest()->getPost('order');
            $couponCode = $appliedRules = '';

            if (isset($data) && isset($data['coupon']['code'])) {
                $couponCode = trim($data['coupon']['code']);
            }
            
            if (!empty($couponCode)) {
                $isApplyDiscount = false;
                foreach ($cartObject->getAllItems() as $item) {
                   $appliedRules = $cartObject->getAppliedRuleIds();
                }
                
                $rulesByCouponCode = $this->multiCouponHelper->getRulesByCouponCode($couponCode);
                $appliedCouponsByRules = $this->multiCouponHelper->getCouponsByRuleIds($appliedRules);
                $invalidCoupons = implode(", ",array_diff(explode(",",$couponCode), $appliedCouponsByRules));
                
                if($invalidCoupons != ''){
                    $this->messageManager->addError(
                        __(
                            '"%1" coupon code is not valid.',
                            $this->escaper->escapeHtml($invalidCoupons)
                        )
                    );
                }
                if (!empty($appliedCouponsByRules) && $couponCode) {
                    $cartObject->setCouponCode(implode(",",array_unique($appliedCouponsByRules)))->collectTotals()->save();
                }
            }
        }
        return $returnValue;
    }
}
