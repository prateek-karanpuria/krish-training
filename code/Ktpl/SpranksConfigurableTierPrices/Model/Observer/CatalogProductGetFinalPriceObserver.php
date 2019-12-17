<?php

namespace Ktpl\SpranksConfigurableTierPrices\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Ktpl\SpranksConfigurableTierPrices\Helper\Data;

/**
 * CatalogProductGetFinalPriceObserver class
 * @package Ktpl\SpranksConfigurableTierPrices\Model\Observer
 */
class CatalogProductGetFinalPriceObserver implements ObserverInterface
{

    /**
     * @var Data
     */
    public $helperData;

    /**
     * @var Session
     */
    public $checkoutSession;

    /**
     * @var Quote
     */
    public $sessionQuote;

    public function __construct(
        Data $helperData,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Backend\Model\Session\Quote $sessionQuote
    )
    {
        $this->helperData = $helperData;
        $this->checkoutSession = $checkoutSession;
        $this->sessionQuote = $sessionQuote;
    }

    /**
     * [execute description]
     * @param  Observer $observer
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();


        // if (!$this->helperData->isExtensionEnabled()
        //     || $this->helperData->isProductInDisabledCategory($product)
        //     || $this->helperData->isExtensionDisabledForProduct($product)
        //     || $product->getTypeId() != \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE) {

        //     return $this;
        // }

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        

        $tierPrices = $product->getTierPrice();

        if (count($tierPrices))
        {
            foreach ($tierPrices as $key => $value) {
                //$logger->info(print_r($value, 1));
            }
        }

        //$tierPrice = $this->_calcConfigProductTierPricing($product);
        $logger->info(count($tierPrices));
        $logger->info($this->calcConfigProductTierPricing($product));

        //$logger->info($product->getCustomAttribute('configtierprices_disabled'));
        //exit('I am in ');

        //$product = $observer->getProduct();
        // if tier prices are defined, also adapt them to configurable products
        /**
         * If tier prices are defined, also adapt them to configurable products
         */
        // if ($product->getTierPriceCount() > 0) {
        //     $tierPrice = $this->_calcConfigProductTierPricing($product);
        //     if ($tierPrice < $product->getData('final_price')) {
        //         $product->setData('final_price', $tierPrice);
        //     }
        // }

        return $this;
    }


    /**
     * Get product final price via configurable product's tier pricing structure.
     * Uses qty of parent item to determine price.
     *
     * @param $product
     *
     * @return  float
     */
    public function calcConfigProductTierPricing($product)
    {
        $tierPrice = PHP_INT_MAX;

        /**
         * Map the mapping IDs of the parent products with the
         * quantities of the corresponding simple products
         */
        if ($items = $this->getAllVisibleItems()) {
            $idQuantities = array();
            
            /**
             * Go through all products in the quote
             */
            foreach ($items as $item) {
                if ($item->getParentItem()) continue;

                /**
                 * This is the product ID of the parent!
                 * map the parent ID with the quantity of the simple product
                 */
                $idQuantities[$id][] = $item->getQty();
            }

            /**
             * Compute the total quantity of items of the configurable product
             */
            if (array_key_exists($product->getId(), $idQuantities)) {
                $totalQty  = array_sum($idQuantities[$product->getId()]);
                $tierPrice = $product->getPriceModel()->getBasePrice($product, $totalQty);
            }
        }

        return $tierPrice;
    }


    /**
     * Retrieves all visible quote items from the session.
     */
    public function getAllVisibleItems()
    {

        if ($this->helperData->isAdmin())
        {
            return $this->sessionQuote->getQuote()->getAllVisibleItems();
        }
        else
        {
            return $this->checkoutSession->getQuote()->getAllVisibleItems();
        }
    }
}
