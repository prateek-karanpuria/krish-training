<?php
/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\OneStepCheckout\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Checkout\Model\CompositeConfigProvider;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Aheadworks\OneStepCheckout\Model\Layout\LayoutProcessorProvider;

/**
 * Class Checkout
 * @package Aheadworks\OneStepCheckout\Block
 */
class Checkout extends Template
{
    /**
     * @var FormKey
     */
    private $formKey;

    /**
     * @var CompositeConfigProvider
     */
    private $configProvider;

    /**
     * @var LayoutProcessorProvider
     */
    private $layoutProcessorProvider;

    /**
     * @param Context $context
     * @param FormKey $formKey
     * @param CompositeConfigProvider $configProvider
     * @param LayoutProcessorProvider $layoutProcessorProvider
     * @param array $data
     */
    public function __construct(
        Context $context,
        FormKey $formKey,
        CompositeConfigProvider $configProvider,
        LayoutProcessorProvider $layoutProcessorProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formKey = $formKey;
        $this->_isScopePrivate = true;
        $this->jsLayout = isset($data['jsLayout']) && is_array($data['jsLayout'])
            ? $data['jsLayout']
            : [];
        $this->configProvider = $configProvider;
        $this->layoutProcessorProvider = $layoutProcessorProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getJsLayout()
    {
        foreach ($this->layoutProcessorProvider->getLayoutProcessors() as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }
        $jsLayout = $this->jsLayout;
        // if(isset($jsLayout['components']['checkout']['children']['email']['children']['billingAddress']['children']['billing-address-fieldset']['children']['city-field-row'])) {
        //     unset($jsLayout['components']['checkout']['children']['email']['children']['billingAddress']['children']['billing-address-fieldset']['children']['city-field-row']);
        // }
        if(isset($jsLayout['components']['checkout']['children']['email']['children']['billingAddress']['children']['billing-address-fieldset']['children']['address-field-row'])) {
            unset($jsLayout['components']['checkout']['children']['email']['children']['billingAddress']['children']['billing-address-fieldset']['children']['address-field-row']);
        }
        // if(isset($jsLayout['components']['checkout']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['city-field-row'])) {
        //     unset($jsLayout['components']['checkout']['children']['shippingAddress']['children']['shipping-address-fieldset']['children']['city-field-row']);
        // }
        $this->jsLayout = $jsLayout;
        return \Zend_Json::encode($this->jsLayout);
    }

    /**
     * Get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    /**
     * Retrieve checkout configuration
     *
     * @return array
     */
    public function getCheckoutConfig()
    {
        return $this->configProvider->getConfig();
    }
}
