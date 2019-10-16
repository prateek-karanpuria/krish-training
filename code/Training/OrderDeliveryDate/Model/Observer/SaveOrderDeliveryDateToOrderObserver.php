<?php

/**
 * Observer class for saving delivery date in quote table
 */

namespace Training\OrderDeliveryDate\Model\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

/**
 * class SaveOrderDeliveryDateToOrderObserver
 * @package SaveOrderDeliveryDateToOrderObserver
 */
class SaveOrderDeliveryDateToOrderObserver implements ObserverInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectmanager)
    {
        $this->_objectManager = $objectmanager;
    }

    /**
     * [execute description]
     * @param  EventObserver $observer [description]
     * @return [type]                  [description]
     */
    public function execute(EventObserver $observer)
    {
        $order = $observer->getOrder();

        $quoteRepository = $this->_objectManager->create('Magento\Quote\Model\QuoteRepository');

        /** 
         * [$quote description]
         * @var [type]
         */
        $quote = $quoteRepository->get($order->getQuoteId());

        $order->setDeliveryDate($quote->getDeliveryDate());

        return $this;
    }
}
