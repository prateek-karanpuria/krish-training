<?php
namespace Reciproci\CommitApis\Observer;
 
use Magento\Framework\Event\ObserverInterface;
use Reciproci\CommitApis\Helper\Notifications\OrderApiNotifications;

class OrderPlaceAfterObserver implements ObserverInterface
{
    public function __construct(OrderApiNotifications $helper)
    {
        $this->helper = $helper;
    }
    
    public function execute( \Magento\Framework\Event\Observer $observer)
    {
        //echo "event executed";die;
        $order = $observer->getEvent()->getOrder();
        $templateVars = [
            'customer_name' => 'Manish Chaubey',
            'subject' => "Boddess Order Placed Notification",
            'message'   => 'Order Placed Succefully'
        ];

        $this->helper->setEmailTemplate($templateVars);
    }
}
