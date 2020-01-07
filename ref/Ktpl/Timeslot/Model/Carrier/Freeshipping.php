<?php
namespace Ktpl\Timeslot\Model\Carrier;

class Freeshipping
{

    const XML_PATH_FREE_SHIPPING_SUBTOTAL = "carriers/freeshipping/free_shipping_subtotal";
    protected $_checkoutSession;
    protected $_scopeConfig;
    private $timeslot;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Ktpl\Timeslot\Model\Timeslot $timeslot,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->timeslot = $timeslot;
        $this->_storeManager = $storeManager;
        $this->_checkoutSession = $checkoutSession;
        $this->_scopeConfig = $scopeConfig;
    }

    public function afterCollectRates(\Magento\OfflineShipping\Model\Carrier\Freeshipping $freeshipping, $result)
    {
        $scopeId = $this->_storeManager->getStore()->getId();
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        $timeslot_id = $this->_checkoutSession->getQuote()->getData('timeslot_id');
        if(!empty($timeslot_id)) {
            $timeslots = $this->timeslot
                        ->getCollection()
                        ->addFieldToFilter('module_status',1)
                        ->addFieldToFilter('timeslot_id',$timeslot_id);
            $status = 0;
            foreach ($timeslots as $timeslot) 
            {
                $status = $timeslot->getData('midnight_status');
            }
            if($status){
                return false;
            }
        } else{
            return false;
        }
        return $result;
    }
}