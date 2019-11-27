<?php

namespace Ktpl\CityDropdown\Model;

/**
 * This class file is used to override estimateByAddressId() function of class
 * \Magento\Quote\Model\ShippingMethodManagement.
 * 
 * In this class method, translated (arabic to english) address will be passed to get output.
 * Also relative private methods are also copied for overriding the functionality completely.
 */

use Magento\Quote\Model\ShippingMethodManagement as MagentoShippingMethodManagement;

/**
 * ShippingMethodManagement class
 * @package Ktpl\CityDropdown\Model
 */
class ShippingMethodManagement extends MagentoShippingMethodManagement
{
    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    public $dataProcessor;

    /**
     * @var \Ktpl\CityDropdown\Helper\TranslateArabicToEnglish
     */
    public $translationProcessor;

    /**
     * Estimate shipping
     *
     * @param int $cartId The shopping cart ID.
     * @param int $addressId The estimate address id
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[] An array of shipping methods.
     */
    public function estimateByAddressId(
        $cartId,
        $addressId
    )
    {
        /**
         * @var \Magento\Quote\Model\Quote $quote
         */
        $quote = $this->quoteRepository->getActive($cartId);

        /**
         * No methods applicable for empty carts or carts with virtual products
         */
        if ($quote->isVirtual() || 0 == $quote->getItemsCount()) {
            return [];
        }
        $address = $this->addressRepository->getById($addressId);

        return $this->_getShippingMethods($quote, $address);
    }

    /**
     * Get list of available shipping methods
     * Referenced from getShippingMethods()
     * 
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Framework\Api\ExtensibleDataInterface $address
     * @return \Magento\Quote\Api\Data\ShippingMethodInterface[]
     */
    public function _getShippingMethods(
        $quote,
        $address
    )
    {
        $output = [];
        $shippingAddress = $quote->getShippingAddress();
        $shippingAddress->addData($this->_extractAddressData($address));
        $shippingAddress->setCollectShippingRates(true);

        /**
         * Get translation class object
         * @var [type]
         */
        $objTranslate = $this->_getTranslationObjectProcessor();

        /**
         * Applied translation for only arabic store view
         */
        if (preg_match('/[^A-Za-z0-9]/', $address->getCity()) || $objTranslate->currentLocale == 'ar_SA') {
            $address->setCity($objTranslate->translate($address->getCity()));
        }

        $this->totalsCollector->collectAddressTotals($quote, $shippingAddress);
        $shippingRates = $shippingAddress->getGroupedAllShippingRates();

        foreach ($shippingRates as $carrierRates) {
            foreach ($carrierRates as $rate) {
                $output[] = $this->converter->modelToDataObject($rate, $quote->getQuoteCurrencyCode());
            }
        }

        return $output;
    }

    /**
     * Get transform address interface into Array
     * Referenced from extractAddressData()
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface  $address
     * @return array
     */
    public function _extractAddressData($address)
    {
        $className = \Magento\Customer\Api\Data\AddressInterface::class;

        if ($address instanceof \Magento\Quote\Api\Data\AddressInterface) {
            $className = \Magento\Quote\Api\Data\AddressInterface::class;
        } elseif ($address instanceof EstimateAddressInterface) {
            $className = \Magento\Quote\Model\EstimateAddressInterface::class;
        }

        return $this->_getDataObjectProcessor()->buildOutputDataArray(
            $address,
            $className
        );
    }

    /**
     * Gets the data object processor
     * Referenced from getDataObjectProcessor()
     * 
     * @return \Magento\Framework\Reflection\DataObjectProcessor
     */
    public function _getDataObjectProcessor()
    {
        if ($this->dataProcessor === null) {
            $this->dataProcessor = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Magento\Framework\Reflection\DataObjectProcessor::class);
        }

        return $this->dataProcessor;
    }

    /**
     * Gets the translation object processor
     * Referenced from getDataObjectProcessor()
     * 
     * @return \Ktpl\CityDropdown\Helper\TranslateArabicToEnglish
     */
    public function _getTranslationObjectProcessor()
    {
        if ($this->translationProcessor === null) {
            $this->translationProcessor = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Ktpl\CityDropdown\Helper\TranslateArabicToEnglish::class);
        }

        return $this->translationProcessor;
    }
}
