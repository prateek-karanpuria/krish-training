<?php

namespace Ktpl\SpranksConfigurableTierPrices\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Attribute code length must be less than 30 symbols
     */
    const ATTRIBUTE_DISABLED_FOR_PRODUCT = 'configtierprices_disabled';

    const XML_PATH_IS_ENABLED = 'spranks_configurabletierprices/general/is_enabled';
    
    const XML_PATH_DISABLED_FOR_CATEGORY = 'spranks_configurabletierprices/general/disabled_for_category';

    /**
     * @var StoreManagerInterface
     */
    public $storeManager;

    /**
     * @var DesignInterface
     */
    public $design;

    /**
     * @var State
     */
    public $state;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\DesignInterface $design,
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\State $state
    )
    {
        $this->storeManager = $storeManager;
        $this->design = $design; # NEED TO REMOVE
        $this->state = $state;
        parent::__construct($context);
    }

    public function isAdmin()
    {
        if ($this->state->getAreaCode() == \Magento\Framework\App\Area::AREA_ADMINHTML) return true;

        if ($this->design->getDesignTheme()->getArea() == 'adminhtml') return true;

        return false;
    }

    public function isExtensionEnabled()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_IS_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function isProductInDisabledCategory($product)
    {
        $disabledSetCategories = $this->scopeConfig->getValue(self::XML_PATH_DISABLED_FOR_CATEGORY, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        $disabledCategories = explode(',', $disabledSetCategories);

        $productCategories  = $product->getAvailableInCategories();

        if (count(array_intersect($disabledCategories, $productCategories)) > 0) {
            return true;
        }

        return false;
    }

    public function isExtensionDisabledForProduct($product)
    {
        /**
         * Get the product attribute
         */
        $configtierpricesDisabled = $product->getAttribute(self::ATTRIBUTE_DISABLED_FOR_PRODUCT);

        if ($configtierpricesDisabled) return true;

        return false;
    }
}
