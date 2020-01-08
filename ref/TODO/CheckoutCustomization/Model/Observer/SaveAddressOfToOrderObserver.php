<?php

namespace Ktpl\CheckoutCustomization\Model\Observer;

/**
 * Observer class for saving delivery date in quote table
 */

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Api\Data\OrderInterface;

/**
 * class SaveAddressOfToOrderObserver
 * @package Ktpl\CheckoutCustomization\Model\Observer
 */
class SaveAddressOfToOrderObserver implements ObserverInterface
{
    /**
     * Execute method
     * 
     * @param  EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        $event = $observer->getEvent();

        /**
         * @var OrderInterface $order
         */
        $order = $event->getOrder();

        /**
         * @var Quote $quote 
         */
        $quote = $event->getQuote();

        $order->setAddresOf($quote->getAddressOf());

        return $this;
    }
}
