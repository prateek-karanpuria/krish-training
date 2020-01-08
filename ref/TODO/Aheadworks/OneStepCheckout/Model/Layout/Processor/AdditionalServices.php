<?php
/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\OneStepCheckout\Model\Layout\Processor;

use Aheadworks\OneStepCheckout\Model\Layout\Processor\AdditionalServices\ServiceComponentPool;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

/**
 * Class AdditionalServices
 * @package Aheadworks\OneStepCheckout\Model\Layout\Processor
 */
class AdditionalServices implements LayoutProcessorInterface
{
    /**
     * @var ArrayManager
     */
    private $arrayManager;

    /**
     * @var ServiceComponentPool
     */
    private $componentPool;

    /**
     * @param ArrayManager $arrayManager
     * @param ServiceComponentPool $componentPool
     */
    public function __construct(
        ArrayManager $arrayManager,
        ServiceComponentPool $componentPool
    ) {
        $this->arrayManager = $arrayManager;
        $this->componentPool = $componentPool;
    }

    /**
     * {@inheritdoc}
     */
    public function process($jsLayout)
    {
        $servicesPath = 'components/checkout/children/checkoutConfig/children/additional-services/children';

        $servicesLayout = $this->arrayManager->get($servicesPath, $jsLayout);
        if ($servicesLayout) {
            foreach ($servicesLayout as $code => &$layout) {
                $serviceComponent = $this->componentPool->getServiceComponent($code);
                if ($serviceComponent) {
                    if (!$serviceComponent->isEnabled()) {
                        unset($servicesLayout[$code]);
                    } else {
                        $serviceComponent->configure($layout);
                    }
                }
            }
            $jsLayout = $this->arrayManager->set($servicesPath, $jsLayout, $servicesLayout);
        }

        $servicesPath = 'components/checkout/children/email/children/billingAddress/children/billing-address-fieldset/children';
        $servicesLayout = $this->arrayManager->get($servicesPath, $jsLayout);
        if ($servicesLayout) {
            foreach ($servicesLayout as $code => &$layout) {
                if($code == 'city-field-row'){
                    $layout['children']['city']['validation']['required-entry'] = true;
                }
            }
            $jsLayout = $this->arrayManager->set($servicesPath, $jsLayout, $servicesLayout);
        }

        $servicesPath = 'components/checkout/children/shippingAddress/children/shipping-address-fieldset/children';
        $servicesLayout = $this->arrayManager->get($servicesPath, $jsLayout);
        if ($servicesLayout) {
            foreach ($servicesLayout as $code => &$layout) {
                if($code == 'city-field-row'){
                    $layout['children']['city']['validation']['required-entry'] = true;
                }
            }
            $jsLayout = $this->arrayManager->set($servicesPath, $jsLayout, $servicesLayout);
        }
        return $jsLayout;
    }
}
