<?php

namespace Ktpl\Signature\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * SalesModelServiceQuoteSubmitBeforeObserver class
 * @package Ktpl\Signature\Model\Observer
 */
class SalesModelServiceQuoteSubmitBeforeObserver implements ObserverInterface
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
            /**
            * @var \Magento\Sales\Model\Order $order
            */
            $order = $observer->getEvent()->getOrder();

            /**
            * @var \Magento\Quote\Model\Quote $quote
            */
            $quote = $observer->getEvent()->getQuote();

            $customerSignature = $quote->getCustomerSignature();

            if ($customerSignature)
            {
                $order->setCustomerSignature($customerSignature);
            }
        }
        catch (\Exception $exception)
        {
            $this->logger->error($exception->getMessage());
        }
    }
}
