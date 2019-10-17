<?php

/**
 * Class to override Magento\Checkout\Block\Checkout\LayoutProcessor using after plugin
 */

namespace Training\OrderDeliveryDate\Plugin\Checkout;

use  Magento\Checkout\Block\Checkout\LayoutProcessor;

/**
 * class LayoutProcessorPlugin
 * @package Training\OrderDeliveryDate\Plugin\Checkout\LayoutProcessorPlugin
 */
class LayoutProcessorPlugin
{
    /**
     * [afterProcess description]
     * @param  LayoutProcessor $subject  [description]
     * @param  array           $jsLayout [description]
     * @return [type]                    [description]
     */
    public function afterProcess(
        LayoutProcessor $subject,
        array $jsLayout
    )
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']['delivery_date'] = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'delivery_date',
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/date', // vendor/magento/module-ui/view/base/web/templates/form/element/date.html
                    'options' => [],
                    'id' => 'delivery-date'
                ],
                'dataScope' => 'delivery_date.delivery_date',
                'label' => 'Delivery Date',
                'provider' => 'checkoutProvider',
                'visible' => true,
                'validation' => [],
                'sortOrder' => 200,
                'id' => 'delivery-date'
            ];

        return $jsLayout;
    }
}
