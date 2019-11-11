<?php


namespace Ktpl\ShippingDate\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const IS_ENABLED = "shipping_date/general/is_enabled";
    const WEEKEND = "general/locale/weekend";

    protected $_scopeConfig;
    protected $_registry;
    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Registry $registry
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_registry = $registry;
        parent::__construct($context);
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_scopeConfig->getValue(self::IS_ENABLED, ScopeInterface::SCOPE_WEBSITES);
    }

    public function getWeekend()
    {
        return $this->_scopeConfig->getValue(self::WEEKEND, ScopeInterface::SCOPE_WEBSITES);
    }

    public function getCurrentProduct()
    {        
        return $this->_registry->registry('current_product');
    }  
}
