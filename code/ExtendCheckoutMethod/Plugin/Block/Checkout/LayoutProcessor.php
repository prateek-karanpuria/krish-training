<?php 

namespace Krish\ExtendCheckoutMethod\Plugin\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as MageLayoutProcessor;

class LayoutProcessor
{

     public function __construct(
        \Magento\Payment\Model\Config $paymentModelConfig
     )
     {
         $this->paymentModelConfig = $paymentModelConfig;
}
    public function afterProcess(MageLayoutProcessor $subject, $jsLayout)
    {
        
                    /*$jsLayout for the shipping address */
                $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
                ['shippingAddress']['children']['shipping-address-fieldset']['children']['postcode'] = [
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'config' => [
                        'customScope' => 'shippingAddress',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/input',
                        'options' => [],
                    ],
                    'dataScope' => 'shippingAddress.postcode',
                    'label' => '  Post/Zip Code',
                    'provider' => 'checkoutProvider',
                    'visible' => true,
                    'validation' => ['required-entry' => true], //Here you can add you validation
                ]; 


        /* config: checkout/options/display_billing_address_on = payment_method */
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['payments-list']['children']
        )) {

            foreach ($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                     ['payment']['children']['payments-list']['children'] as $key => $payment) {
               $method = substr($key, 0, -5);
                    

                   /* Disabled company Field*/
                if (isset($payment['children']['form-fields']['children']['company'])) {

                    $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                    ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                    ['company']= ['visible' => false ];
                }

                
                /* Required field for the Postcode */
                $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$key]['children']['form-fields']['children']
                ['postcode'] = [
                    'component' => 'Magento_Ui/js/form/element/abstract',
                    'config' => [
                        'customScope' => 'billingAddress' . $method,
                        'customEntry' => null,
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/input',
                        'tooltip' => null,
                    ],
                    'dataScope' => 'billingAddress' . $method . '.postcode',
                    'dataScopePrefix' => 'billingAddress' . $method,
                    'label' => __('Post/Zip Code'),
                    'provider' => 'checkoutProvider',
                    'validation' => [],
                    'validation' => ['required-entry' => true],
                    'options' => [],
                    'filterBy' => null,
                    'customEntry' => null,
                    'visible' => true,
                ];

                /* Required field for street address*/
            }
        }

        /* config: checkout/options/display_billing_address_on = payment_page */
        if (isset($jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['afterMethods']['children']['billing-address-form']
        )) {
            $method = 'shared';

            /* postcode */
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
            ['payment']['children']['afterMethods']['children']['billing-address-form']['children']['form-fields']
            ['children']['postcode'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'billingAddress' . $method,
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'tooltip' => null,
                ],
                'dataScope' => 'billingAddress' . $method . '.postcode',
                'dataScopePrefix' => 'billingAddress' . $method,
                'label' => __('Post/Zip Code'),
                'provider' => 'checkoutProvider',
                'validation' => [],
                'options' => [],
                'filterBy' => null,
                'customEntry' => null,
                'validation' => ['required-entry' => true],
                'visible' => true,
            ];
        }

        

        return $jsLayout;
    }
}



