<?php

namespace Ktpl\SpranksConfigurableTierPrices\Helper;

/**
 * This class contains extension related additional functionality & string literals.
 */

/**
 * Data class
 * @package Ktpl\SpranksConfigurableTierPrices\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Attribute code length must be less than 30 symbols
     */
    const ATTRIBUTE_DISABLED_FOR_PRODUCT = 'configtierprices_disabled';

    const XML_PATH_IS_ENABLED = 'spranks_configurabletierprices/general/is_enabled';
    
    const XML_PATH_DISABLED_FOR_CATEGORY = 'spranks_configurabletierprices/general/disabled_for_category';

    /**
     * @var DesignInterface
     */
    public $design;

    /**
     * @var State
     */
    public $state;

    /**
     * @var ProductFactory
     */
    public $productFactory;

    /**
     * [__construct description]
     * @param \Magento\Framework\View\DesignInterface $design         [description]
     * @param \Magento\Framework\App\Helper\Context   $context        [description]
     * @param \Magento\Framework\App\State            $state          [description]
     * @param \Magento\Catalog\Model\ProductFactory   $productFactory [description]
     */
    public function __construct(
        \Magento\Framework\View\DesignInterface $design,
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\State $state,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->design = $design;
        $this->state = $state;
        $this->productFactory = $productFactory;

        parent::__construct($context);
    }

    /**
     * Check whether in admin area or not
     * 
     * @return boolean
     */
    public function isAdmin()
    {
        if ($this->state->getAreaCode() == \Magento\Framework\App\Area::AREA_ADMINHTML) return true;

        if ($this->design->getDesignTheme()->getArea() == \Magento\Framework\App\Area::AREA_ADMINHTML) return true;

        return false;
    }

    /**
     * [isExtensionEnabled description]
     * 
     * @return boolean [description]
     */
    public function isExtensionEnabled()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_IS_ENABLED, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if product category listed in disabled category
     * 
     * @param  [type]  $product
     * @return boolean
     */
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

    /**
     * Check if extension is disabled for product
     * 
     * @param  [type]  $product
     * @return boolean
     */
    public function isExtensionDisabledForProduct($product)
    {
        $product = $this->productFactory->create()->load($product->getId());

        /**
         * Get the product attribute from factory as attribute value may not be loaded
         */
        $configtierpricesDisabled = $product->getData('configtierprices_disabled');

        if ($configtierpricesDisabled) return true;

        return false;
    }
}
