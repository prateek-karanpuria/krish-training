<?php

namespace Ktpl\Timeslot\Controller\Index;

class Shippingprice extends \Magento\Framework\App\Action\Action
{
    private $timeslot;
    private $_http;
    private $_quote;
    private $_checkoutSession;
    private $_result;
    private $timeZoneResolver;

    public function __construct(
        \Ktpl\Timeslot\Model\Timeslot $timeslot,
        \Magento\Framework\App\Request\Http $http,
        \Magento\Quote\Model\Quote $quote,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timeZoneResolver,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->timeslot = $timeslot;
        $this->_http = $http;
        $this->_quote = $quote;
        $this->_checkoutSession = $checkoutSession;
        $this->timeZoneResolver = $timeZoneResolver;
        parent::__construct($context);
    }
    public function execute()
    {
        $post = $this->getRequest()->getParams();
        
        if(array_key_exists('id', $post) && array_key_exists('time', $post) && array_key_exists('datepicker', $post))
        {
            $id = $post['id'];
            $time = $post['time'];
            $datepicker = $post['datepicker'];
            if($id != "" && $id != "undefined" && $time != "" && $time != "undefined" && $datepicker != "" && $datepicker != "undefined")
            {
                $timeslots = $this->timeslot
                        ->getCollection()
                        ->addFieldToFilter('module_status',1)
                        ->addFieldToFilter('timeslot_id',$id);
                $results = array();

                $timeslotsbk = $this->getHttp()->getParam('timeslot');
                $quote = $this->getQuote();
                foreach ($timeslots as $timeslot) 
                {
                    try{
                        $date = date_create($datepicker." 16:00:00");
                        $date = date_format($date,"Y-m-d H:i:s");
                        $quote->setData('timeslot_id',$id);
                        $quote->setData('timeslot_time',$time);
                        $quote->setData('timeslot_rate',$timeslot->getData('shipping_charge'));
                        $quote->setData('aw_delivery_date_from',$date);
                        $quote->setData('aw_delivery_date_to',$date);
                        $quote->setData('aw_delivery_date',$date);
                        $quote->save();
                    }
                    catch(Exception $e){
                        $this->_result['message'] = $e->getMessage();
                    }
                }    
            }
            else
            {
                $id = "";
                $time = "";
                $rate = 40;
                $quote = $this->getQuote();
                $quote->setData('timeslot_id',$id);
                $quote->setData('timeslot_time',$time);
                $quote->setData('timeslot_rate',$rate);
                $quote->setData('aw_delivery_date_from',"");
                $quote->setData('aw_delivery_date_to',"");
                $quote->setData('aw_delivery_date',"");
                $quote->save();
            }
        }
        else
        {
            $id = "";
            $time = "";
            $rate = 40;
            $quote = $this->getQuote();
            $quote->setData('timeslot_id',$id);
            $quote->setData('timeslot_time',$time);
            $quote->setData('timeslot_rate',$rate);
            $quote->setData('aw_delivery_date_from',"");
            $quote->setData('aw_delivery_date_to',"");
            $quote->setData('aw_delivery_date',"");
            $quote->save();
        }
    }

    public function getHttp()
    {
        return $this->_http;
    }

    public function getQuote()
    {
        return $this->_checkoutSession->getQuote();
    }
}