<?php

namespace Training\OrderDeliveryDate\Model\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

/**
 * class AddHtmlToOrderShippingViewObserver
 * @package Training\OrderDeliveryDate\Model\Observer
 */
class AddHtmlToOrderShippingViewObserver implements ObserverInterface
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
        if ($observer->getElementName() == 'order_shipping_view')
        {
            $orderShippingViewBlock = $observer->getLayout()->getBlock($observer->getElementName());
            $order = $orderShippingViewBlock->getOrder();
            $localeDate = $this->_objectManager->create('\Magento\Framework\Stdlib\DateTime\TimezoneInterface');
            $formattedDate = $localeDate->formatDate(
                $localeDate->scopeDate(
                    $order->getStore(),
                    $order->getDeliveryDate(),
                    true
                ),
                \IntlDateFormatter::MEDIUM,
                false
            );

            $deliveryDateBlock = $this->_objectManager->create('Magento\Framework\View\Element\Template');
            $deliveryDateBlock->setDeliveryDate($formattedDate);
            $deliveryDateBlock->setTemplate('Training_OrderDeliveryDate::order_info_shipping_info.phtml');
            $html = $observer->getTransport()->getOutput() . $deliveryDateBlock->toHtml();
            $observer->getTransport()->setOutput($html);
        }
    }
}
