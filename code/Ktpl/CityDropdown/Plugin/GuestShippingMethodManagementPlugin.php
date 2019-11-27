<?php

/**
 * Before plugin to translate Arabic city name default sort order of searched product listing
 */

namespace Ktpl\CityDropdown\Plugin;

use Magento\Quote\Model\GuestCart\GuestShippingMethodManagement;
use Magento\Quote\Api\Data\AddressInterface;

use Ktpl\CityDropdown\Helper\TranslateArabicToEnglish;

/**
 * class GuestShippingMethodManagementPlugin
 * @package Ktpl\CityDropdown\Plugin
 */
class GuestShippingMethodManagementPlugin extends TranslateArabicToEnglish
{
    /**
     * Modify address argument of estimateByExtendedAddress() function which estimate shipping
     * by address and return list of available shipping methods
     *
     * API call: 
     *     /V1/carts/mine/estimate-shipping-methods
     *     /V1/guest-carts/estimate-shipping-methods
     * Interface:
     *     Magento\Quote\Api\ShipmentEstimationInterface
     * 
     * [beforeEstimateByExtendedAddress description]
     * @param  GuestShippingMethodManagement $objGuestShippingMethodManagement
     * @param  mixed $cartId
     * @param  AddressInterface $address
     * @return mix array []
     */
    public function beforeEstimateByExtendedAddress(
        GuestShippingMethodManagement $objGuestShippingMethodManagement,
        $cartId,
        AddressInterface $address
    )
    {
        // $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        // $logger = new \Zend\Log\Logger();
        // $logger->addWriter($writer);

        // $logger->info('-------------------GUEST----------------------');
        // $logger->info('City: '.$address->getCity());
        // $logger->info('Postcode: '.$address->getPostcode());
        // $logger->info('Local Code: '.$this->currentLocale);

        /**
         * Applied translation for only arabic store view
         */
        if (preg_match('/[^A-Za-z0-9]/', $address->getCity()) || $this->currentLocale == 'ar_SA') {
            $address->setCity($this->translate($address->getCity()));
        }

        // if (preg_match('/[^A-Za-z0-9]/', $address->getPostcode()) || $this->currentLocale == 'ar_SA')
        // {
        //     $address->setPostcode($this->translate($address->getPostcode()));
        // }

        // $logger->info('City: '.$address->getCity());
        // $logger->info('Postcode: '.$address->getPostcode());
        // $logger->info('Local Code: '.$this->currentLocale);
        // $logger->info('-------------------------------------------------');

        return [$cartId, $address];
    }
}
