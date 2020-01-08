<?php
/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\OneStepCheckout\Model\Layout\Processor\PaymentOptions;

use Aheadworks\OneStepCheckout\Model\Config;

/**
 * Class Filter
 * @package Aheadworks\OneStepCheckout\Model\Layout\Processor\PaymentOptions
 */
class Filter
{
    /**
     * @var Config
     */
    private $config;
    protected $_cart;    
    protected $_checkoutSession;
    protected $_productloader;

    /**
     * @param Config $config
     */
    public function __construct(Config $config,\Magento\Checkout\Model\Cart $cart,\Magento\Checkout\Model\Session $checkoutSession,\Magento\Catalog\Model\ProductFactory $_productloader)
    {
        $this->config = $config;
        $this->_cart = $cart;
        $this->_checkoutSession = $checkoutSession;
        $this->_productloader = $_productloader;
    }

    /**
     * Filter payment options definitions
     *
     * @param array $config
     * @return array
     */
    public function filter(array $config)
    {
        $quote = $this->getCheckoutSession()->getQuote();
        $items = $quote->getAllItems();
        $productInSales = 0;
        foreach($items as $item) {
            // echo "<pre>";
            // print_r($item->getData());
            // exit;
            $productId = $item->getProductId();
            $product = $this->_productloader->create()->load($productId);
            // echo "<pre>";
            // print_r($product->getData());
            // exit;
            if($product->getId() > 0)
            {
                $specialprice = $product->getSpecialPrice();
                $specialPriceFromDate = $product->getSpecialFromDate();
                $specialPriceToDate = $product->getSpecialToDate();
                $today =  time();

            if ($specialprice && ($product->getPrice()>$product->getFinalPrice())):
                    if($today >= strtotime( $specialPriceFromDate) && $today <= strtotime($specialPriceToDate) || 
                $today >= strtotime( $specialPriceFromDate) && is_null($specialPriceToDate)):
                        $productInSales = 1;
                        break;
                endif;
                $productInSales = 1;
                    break; 
            endif;
            }
        }
        if($productInSales == 1)
        {
            //echo "hellllll";exit;
            //unset($config['discount']);
        }
        else if (isset($config['discount']) && !$this->config->isApplyDiscountCodeEnabled()) {
            unset($config['discount']);
        }
        return $config;
    }

    public function getCart()
    {        
        return $this->_cart;
    }
    
    public function getCheckoutSession()
    {
        return $this->_checkoutSession;
    }
}
