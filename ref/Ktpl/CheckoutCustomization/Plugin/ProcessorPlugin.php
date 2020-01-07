<?php

namespace Ktpl\CheckoutCustomization\Plugin;

/**
 * ProcessAddressOfPlugin class
 * @package Ktpl\CheckoutCustomization\Plugin
 */
class ProcessorPlugin
{
    public function afterProcess(
        \Aheadworks\OneStepCheckout\Model\Layout\Processor\AddressAttributes $subject,
        $jsLayout
    )
    {
        $addressOfAttributeCode = 'address_of';

        $addressOfFieldConfigurations = [
            'component' => 'Magento_Ui/js/form/element/checkbox-set',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox-set',
                'id' => 'address_of',
                'options' => [
                    [
                        'value' => 0,
                        'label' => 'Home',
                    ],
                    [
                        'value' => 1,
                        'label' => 'Office',
                    ],
                    [
                        'value' => 2,
                        'label' => 'Others',
                    ],
                ],
            ],
            'dataScope' => 'shippingAddress.address_of',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'id' => 'address_of',
            'validation' => [],
            'visible' => true,
            'value' => '0', // Default value
            'additionalClasses' => 'addressOf',
        ];

        $jsLayout['components']['checkout']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['address-field-row']['children'][$addressOfAttributeCode] = $addressOfFieldConfigurations;

        return $jsLayout;
    }
}
