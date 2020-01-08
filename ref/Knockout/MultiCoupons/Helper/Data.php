<?php
/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
namespace RB\MultiCoupons\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Description of Data
 *
 * @author Rocket Bazaar Core Team
 */

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Coupon factory
     *
     * @var \Magento\SalesRule\Model\CouponFactory
     */
    protected $couponFactory;

    /**
     * Rules factory
     *
     * @var \Magento\SalesRule\Model\CouponFactory
     */
    protected $rulesFactory;
    protected $moduleManager;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\SalesRule\Model\CouponFactory $couponFactory,
        \Magento\SalesRule\Model\RuleFactory $rulesFactory,
        \Magento\Framework\Module\Manager $moduleManager
    ) {
        parent::__construct($context);
        $this->couponFactory = $couponFactory;
        $this->rulesFactory = $rulesFactory;
        $this->moduleManager = $moduleManager;
    }
    
    public function isEnabled($storeId = null)
    {
        return $this->getConfigValue('rb_multicoupons/general/enable', $storeId);
    }
    
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getRulesByCouponCode($couponCodeData = ''){
        $couponCodes = explode(",",$couponCodeData);
        $appliedRules = [];
        if(!empty($couponCodes)){
            foreach($couponCodes as $couponCode){
                $coupon = $this->couponFactory->create();
                $coupon->load($couponCode, 'code');
                if($coupon->getId()){
                    $appliedRules[] = $coupon->getRuleId();
                }
            }
        }
        return $appliedRules;
    }

    public function getCouponsByRuleIds($ruleIdsData = ''){
        $ruleIds = explode(",",$ruleIdsData);
        $appliedCoupons = [];

        if(!empty($ruleIds)){
            foreach($ruleIds as $ruleId){
                $ruleModel = $this->rulesFactory->create();
                $rule = $ruleModel->load($ruleId);
                if($rule->getCouponCode()){
                    $appliedCoupons[] = $rule->getCouponCode();
                }
            }
        }
        return $appliedCoupons;
    }

    public function getIWDComponentPath(){
        if($this->isEnabled() && $this->moduleManager->isEnabled('IWD_Opc')){
            return 'RB_MultiCoupons/js/view/iwd/discount';
        }elseif(!$this->isEnabled() && $this->moduleManager->isEnabled('IWD_Opc')){
            return 'IWD_Opc/js/view/discount/discount';
        }else{
            return;
        }
    }

    public function getIWDTemplatePath(){
        if($this->isEnabled() && $this->moduleManager->isEnabled('IWD_Opc')){
            return 'RB_MultiCoupons/view/iwd/discount';
        }elseif(!$this->isEnabled() && $this->moduleManager->isEnabled('IWD_Opc')){
            return 'IWD_Opc/payment/discount';
        }else{
            return;
        }
    }

    public function getMagentoComponentPath(){
        if($this->isEnabled()){
            return 'RB_MultiCoupons/js/view/cart/discount';
        }
        return 'Magento_SalesRule/js/view/payment/discount';
    }

    public function getMagentoTemplatePath(){
        if($this->isEnabled()){
            return 'RB_MultiCoupons/view/cart/discount';
        }
        return 'Magento_SalesRule/payment/discount';
    }
}
