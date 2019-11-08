<?php
namespace Ktpl\PurchaseOrder\Observer;

class UpdateOrderPo implements \Magento\Framework\Event\ObserverInterface
{

	protected $_orderRepository;
	protected $_quoteRepository;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepositoryInterface,
    	\Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface
    ) {
        $this->_orderRepository = $orderRepositoryInterface;
        $this->_quoteRepository = $cartRepositoryInterface;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        foreach($orderIds as $orderId){
			$order = $this->_orderRepository->get($orderId);
			$quote = $this->_quoteRepository->get($order->getQuoteId());
			$order->setDcPoNumber($quote->getDcPoNumber());
			$order->save();
        }
    }
}