<?php


namespace Ktpl\ShippingDate\Block;

class Shippingdate extends \Magento\Framework\View\Element\Template
{

    protected $holidayModel;
    protected $_storeManager;
    protected $_helper;
    protected $_holidayCount = 0;
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,        
        \Ktpl\ShippingDate\Model\HolidayFactory $holidayModel,
        \Ktpl\ShippingDate\Helper\Data $helper,
        array $data = []
    ) {        
        $this->holidayModel = $holidayModel;
        $this->_storeManager = $storeManager;
        $this->_helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getHolidayDates()
    {    
        $weekend = explode(",", $this->_helper->getWeekend());
        // current day to start with
        date_default_timezone_set("America/Chicago");
        $currDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + $this->_holidayCount, date('Y')));

        $timestamp = strtotime($currDate);
        $day = date('w', $timestamp);

        if (!in_array($day, $weekend)):
            $websiteId = $this->_storeManager->getStore()->getWebsiteId();
            $collection = $this->holidayModel->create()->getCollection()->addFieldToFilter('enabled', array('eq' => "1"))->addFieldToFilter('website_id', array('finset' => $websiteId))->addFieldToFilter('holiday_date', array('eq' => $currDate));
                        
            if (!empty($collection->getData())):
                $this->_holidayCount++;
                $this->getHolidayDates();
            else:
                if($this->_holidayCount == 0):

                    if(date("H") < 14){

                        $shipdate = date('l', $timestamp).' '.date('m',$timestamp).'/'.date('d',$timestamp);
                        echo $shipdate;
                    }else{
                        $this->_holidayCount++;
                        $this->getHolidayDates();
                    }

                else:
                    $shipdate = date('l', $timestamp).' '.date('m',$timestamp).'/'.date('d',$timestamp);
                    echo $shipdate;
                endif;
            endif;
        else:
            $this->_holidayCount++;
            $this->getHolidayDates();
        endif;
    } 

}