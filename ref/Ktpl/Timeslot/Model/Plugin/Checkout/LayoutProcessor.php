<?php
namespace Ktpl\Timeslot\Model\Plugin\Checkout;
class LayoutProcessor
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    protected $timezone;

    public function __construct(
         \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
    ) 
    {
        $this->timezone = $timezone;
    }

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['shipping_date'] = [
            'component' => 'Magento_Ui/js/form/element/date',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'id' => 'shipping-date',
                'options' => [  
                    'minDate' => $this->timezone->formatDate(),
                ]
            ],
            'dataScope' => 'shippingAddress.shipping_date',
            'label' => 'Select Date',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 249,
            'id' => 'shipping-date',
            'validation' => [
                'required-entry'=> true,
            ]
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['shipping_time_slot'] = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'options' => [],
                'id' => 'shipping-time-slot'
            ],
            'dataScope' => 'shippingAddress.shipping_time_slot',
            'label' => 'Select Time Slot',
            'provider' => 'checkoutProvider',
            'visible' => false,
            'validation' => [],
            'sortOrder' => 250,
            'id' => 'shipping-time-slot',
            'validation' => [
                'required-entry'=> true,
            ]
        ];
        
 
        return $jsLayout;
    }
}