<?php

namespace Ktpl\Signature\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * SalesOrderShipmentSaveAfterObserver class
 * @package Ktpl\Signature\Model\Observer
 */
class SalesOrderShipmentSaveAfterObserver implements ObserverInterface
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
            $shipment = $observer->getEvent()->getShipment();
            $order = $shipment->getOrder();
            $customerSignature = $order->getCustomerSignature();

            if ($customerSignature)
            {
                $shipment->setCustomerSignature($customerSignature);
                $shipment->save();
            }
        }
        catch (\Exception $exception)
        {
            $this->logger->error($exception->getMessage());
        }
    }
}
