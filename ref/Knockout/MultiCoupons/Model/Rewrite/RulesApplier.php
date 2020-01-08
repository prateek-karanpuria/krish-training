<?php
/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
namespace RB\MultiCoupons\Model\Rewrite;

use Magento\Quote\Model\Quote\Address;

/**
 * Description of RulesApplier
 *
 * @author Rocket Bazaar Core Team
 */
class RulesApplier extends \Magento\SalesRule\Model\RulesApplier
{
    /**
     * Application Event Dispatcher
     *
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $_eventManager;

    /**
     * @var \Magento\SalesRule\Model\Utility
     */
    protected $validatorUtility;

    /**
     * Multiple Coupon Helper
     *
     * @var \RB\MultiCoupons\Helper\Data
     */
    protected $multiCouponHelper;

    /**
     * @param \Magento\SalesRule\Model\Rule\Action\Discount\CalculatorFactory $calculatorFactory
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param \Magento\SalesRule\Model\Utility $utility
     */
    public function __construct(
        \Magento\SalesRule\Model\Rule\Action\Discount\CalculatorFactory $calculatorFactory,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\SalesRule\Model\Utility $utility,
        \RB\MultiCoupons\Helper\Data $multiCouponHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct(
            $calculatorFactory,
            $eventManager,
            $utility
        );
        $this->calculatorFactory = $calculatorFactory;
        $this->validatorUtility = $utility;
        $this->_eventManager = $eventManager;
        $this->_storeManager = $storeManager;
        $this->multiCouponHelper = $multiCouponHelper;
    }
    /**
     * Apply rules to current order item
     *
     * @param \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @param \Magento\SalesRule\Model\ResourceModel\Rule\Collection $rules
     * @param bool $skipValidation
     * @param mixed $couponCode
     * @return array
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function applyRules($item, $rules, $skipValidation, $couponCode)
    {
        $storeId = $this->_storeManager->getStore()->getId();
        if(!$this->multiCouponHelper->isEnabled($storeId)) {
            return parent::applyRules($item, $rules, $skipValidation, $couponCode);
        }

        $address = $item->getAddress();
        $appliedRuleIds = [];
        //echo debug_backtrace()[1]['function'].  " " . $address->getAppliedMultipleRules();
        /* @var $rule \Magento\SalesRule\Model\Rule */
        foreach ($rules as $rule) {

            // Check if current rule is already applied to cart, if yes, continue loop
            if (!$this->validatorUtility->canProcessRule($rule, $address) ||
                (in_array($rule->getId(),explode(",",$address->getAppliedMultipleRules())) && $rule->getCouponCode() == '') /* Condition to check if rule already applied */
            ) {
                continue;
            }
            
            if (!$skipValidation && !$rule->getActions()->validate($item, $rule)) {
                $childItems = $item->getChildren();
                $isContinue = true;
                if (!empty($childItems)) {
                    foreach ($childItems as $childItem) {
                        if ($rule->getActions()->validate($childItem, $rule)) {
                            $isContinue = false;
                        }
                    }
                }
                if ($isContinue) {
                    continue;
                }
            }

            $this->applyRule($item, $rule, $address, $couponCode);
            $appliedRuleIds[$rule->getRuleId()] = $rule->getRuleId();

            if ($rule->getStopRulesProcessing()) {
                $address->setStopRuleProcessing(true);
                break;
            }
        }

        return $appliedRuleIds;
    }
}
