<?php
namespace Reciproci\CommitApis\Observer;
 
use Magento\Framework\Event\ObserverInterface;
use Reciproci\CommitApis\Helper\Notifications\OrderApiNotifications;
 
class OrderCancelAfterObserver implements ObserverInterface
{
    public function __construct(OrderApiNotifications $helper)
    {
        $this->helper = $helper;
    }

    public function execute( \Magento\Framework\Event\Observer $observer)
    {
        
        $order = $observer->getEvent()->getOrder();
        $templateVars = [
            'customer_name' => 'Manish Chaubey',
            'subject' => "Boddess Order Cancell Notification",
            'message'   => 'Order Cancelled successfully'
        ];
        $this->helper->setEmailTemplate($templateVars);
    }
}
