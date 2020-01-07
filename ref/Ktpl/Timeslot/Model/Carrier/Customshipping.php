<?php
namespace Ktpl\Timeslot\Model\Carrier;
 
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;
 
class Customshipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements
    \Magento\Shipping\Model\Carrier\CarrierInterface
{

    protected $_code = 'customshipping';
    private $_quote;
    private $_checkoutSession;
    private $timeslot;
 
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Ktpl\Timeslot\Model\Timeslot $timeslot,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote $quote,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->_quote = $quote;
        $this->timeslot = $timeslot;
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function getAllowedMethods()
    {
        return ['customshipping' => $this->getConfigData('name')];
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) 
        {
            return false;
        }
        $result = $this->_rateResultFactory->create();
        $method = $this->_rateMethodFactory->create();
        $method->setCarrier('customshipping');
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod('customshipping');
        $method->setMethodTitle($this->getConfigData('name'));
        $quote = $this->_checkoutSession->getQuote();
        $amount = "";
        if($quote->getData('timeslot_rate') != "")
        {
            $amount = $quote->getData('timeslot_rate');
        }
        else
        {
            $amount = $this->getConfigData('price');    
        }
        $method->setPrice($amount);
        $method->setCost($amount);
        $result->append($method);
        $timeslot_id = $this->_checkoutSession->getQuote()->getData('timeslot_id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $conf = $objectManager->get('Magento\Framework\App\Config\ScopeConfigInterface')->getValue('carriers/freeshipping/free_shipping_subtotal',\Magento\Store\Model\ScopeInterface::SCOPE_STORES);
        if(!empty($timeslot_id) && $quote->getData('grand_total') > $conf) {
            $timeslots = $this->timeslot
                        ->getCollection()
                        ->addFieldToFilter('module_status',1)
                        ->addFieldToFilter('timeslot_id',$timeslot_id);
            $status = 0;
            foreach ($timeslots as $timeslot) 
            {
                $status = $timeslot->getData('midnight_status');
            }
            if(!$status){
                return false;
            }
        }
        return $result;
    }
}