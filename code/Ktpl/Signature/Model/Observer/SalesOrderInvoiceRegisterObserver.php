<?php

namespace Ktpl\Signature\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * SalesOrderInvoiceRegisterObserver class
 * @package Ktpl\Signature\Model\Observer
 */
class SalesOrderInvoiceRegisterObserver implements ObserverInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    public $logger;

    /**
     * [__construct description]
     * @param \Psr\Log\LoggerInterface $logger [description]
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    /**
     * [execute description]
     * @param  Observer $observer
     */
    public function execute(Observer $observer)
    {
        try
        {
            $invoice = $observer->getEvent()->getInvoice();
            $order = $invoice->getOrder();
            $customerSignature = $order->getCustomerSignature();

            if ($customerSignature)
            {
                $invoice->setCustomerSignature($customerSignature);  
            }
        }
        catch (\Exception $exception)
        {
            $this->logger->error($exception->getMessage());
        }
    }
}
