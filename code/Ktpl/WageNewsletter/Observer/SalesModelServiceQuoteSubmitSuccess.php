<?php

namespace Ktpl\WageNewsletter\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Newsletter\Model\SubscriberFactory;

/**
 * SalesModelServiceQuoteSubmitSuccess class
 * @package Ktpl\WageNewsletter\Observer
 */
class SalesModelServiceQuoteSubmitSuccess implements ObserverInterface
{
    /**
     * @var SubscriberFactory
     */
    public $subscriber;

    /**
     * @var LoggerInterface
     */
    public $logger;

    /**
     * @param Subscriber $subscriber
     * @param LoggerInterface $logger
     */
    public function __construct(
        SubscriberFactory $subscriberFactory,
        LoggerInterface $logger
    )
    {
        $this->subscriberFactory = $subscriberFactory->create();
        $this->logger = $logger;
    }

    /**
     * Subscribe to newsletters if customer checked the checkbox
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();

        $email = 'undefined';

        try
        {
            $email = $quote->getCustomerEmail();

            /**
             * Subscribes by email
             *
             * @param string $email
             * @throws \Exception
             * @return int
             *
             */
            $this->subscriberFactory->subscribe($email);
        }
        catch (\Exception $exception)
        {
            $this->logger->error('Ktpl WageNewsletter Issue '.$exception->getMessage() . 'to ' . $email);
        }

        return $this;
    }
}
