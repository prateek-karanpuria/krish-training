<?php
/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\OneStepCheckout\Block\Adminhtml\Order\Invoice;

use Aheadworks\OneStepCheckout\Block\Adminhtml\Order\AbstractDeliveryDate;
use Magento\Framework\Registry;
use Magento\Backend\Block\Template\Context;
use Magento\Sales\Model\Order\Invoice;

/**
 * Class DeliveryDate
 * @package Aheadworks\OneStepCheckout\Block\Adminhtml\Order\Invoice
 */
class DeliveryDate extends AbstractDeliveryDate
{
    /**
     * @var Registry
     */
    private $coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->coreRegistry = $coreRegistry;
    }

    /**
     * {@inheritdoc}
     */
    protected function getOrder()
    {
        /** @var Invoice $invoice */
        $invoice = $this->coreRegistry->registry('current_invoice');
        return $invoice->getOrder();
    }
}
