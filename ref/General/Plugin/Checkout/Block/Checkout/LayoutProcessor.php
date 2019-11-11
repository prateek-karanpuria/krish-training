<?php

namespace Ktpl\General\Plugin\Checkout\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as MageLayoutProcessor;

class LayoutProcessor
{
    public function afterProcess(MageLayoutProcessor $subject, $jsLayout)
    {
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['company'])) {

            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['company']['label'] = __('Company Name'); 
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['company'])) {

            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['company']['label'] = __('Company Name'); 
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['country_id'])) {
             $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['country_id']['sortOrder'] = 79; 
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['region_id'])) {
             $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['region_id']['sortOrder'] = 85; 
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['region'])) {
             $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['region']['sortOrder'] = 85; 
        }
        
        /* Pay by Check Billing Address changes */
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['country_id'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['country_id']['sortOrder'] = 79;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['region_id'])) {
             $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['region_id']['sortOrder'] = 85; 
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['region'])) {
             $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['region']['sortOrder'] = 85; 
        }
        
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['fax'])) {
            unset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['checkmo-form']['children']['form-fields']['children']['fax']);
        }
        /* Pay by Check Billing Address changes ends*/

        /* MD Authorize CIM Billing Address changes */
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['country_id'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['country_id']['sortOrder'] = 79;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['region_id'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['region_id']['sortOrder'] = 85;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['region'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['region']['sortOrder'] = 85;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['fax'])) {
            unset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['md_authorizecim-form']['children']['form-fields']['children']['fax']);
        }
        /* MD Authorize CIM Billing Address changes ends*/

        /* COD Billing Address changes */
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['country_id'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['country_id']['sortOrder'] = 79;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['region_id'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['region_id']['sortOrder'] = 85;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['region'])) {
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['region']['sortOrder'] = 85;
        }

        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['fax'])) {
            unset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children']['cashondelivery-form']['children']['form-fields']['children']['fax']);
        }
        /* COD Billing Address changes ends*/

        return $jsLayout;
    }
}