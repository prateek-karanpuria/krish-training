<?php
namespace Ktpl\Timeslot\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    private $timeslot;
    protected $priceCurrency;
    protected $timezone;
    public function __construct(
        \Ktpl\Timeslot\Model\Timeslot $timeslot,
        \Ktpl\Timeslot\Model\ResourceModel\Timeslot\CollectionFactory $timeslotCollectionFactory,
        \Magento\Framework\Pricing\Helper\Data $priceCurrency,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->timeslot                  = $timeslot;
        $this->priceCurrency             = $priceCurrency;
        $this->timeslotCollectionFactory = $timeslotCollectionFactory;
        $this->timezone                  = $timezone;
        parent::__construct($context);
    }
    public function execute()
    {
        $post       = $this->getRequest()->getPost();
        $country_id = $post['country_id'];
        $region_id  = $post['region_id'];
        if ($country_id != "" && $region_id != "" && $country_id != "undefined" && $region_id != "undefined") {
            $timeslots = $this->timeslot
                ->getCollection()
                ->addFieldToFilter('module_status', 1)
                ->addFieldToFilter('country_id', $country_id)
                ->addFieldToFilter('state_id', $region_id);
            $finalstr = "";
            foreach ($timeslots as $timeslot) {
                $start = date('h:i a', strtotime($timeslot->getData('start_date')));
                if ($timeslot->getData('cutoff_time')) {
                    $cutoff = date('h:i a', strtotime($timeslot->getData('cutoff_time')));
                } else {
                    $cutoff = date('h:i a', strtotime($timeslot->getData('end_date')));
                }
                $end             = date('h:i a', strtotime($timeslot->getData('end_date')));
                $current_time    = date('h:i a', strtotime($this->timezone->date()->format('h:i a')));
                $shipping_charge = $this->priceCurrency->currency($timeslot->getData('shipping_charge'), true, false);
                sscanf(date('h:i:s', strtotime($timeslot->getData('start_date'))), "%d:%d:%d", $hours, $minutes, $seconds);
                $start_time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                sscanf(date('h:i:s', strtotime($timeslot->getData('end_date'))), "%d:%d:%d", $hours, $minutes, $seconds);
                $end_time_seconds = isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;
                if (strtotime($cutoff) >= strtotime($end)) {
                    //$cutoff = date('h:i a', strtotime($timeslot->getData('end_date')));
                }
                if ($finalstr == "") {
                    if (strtotime($post['date']) === strtotime('today')) {
                        if (strtotime($current_time) >= strtotime($start) && strtotime($current_time) <= strtotime($cutoff)) {
                            $finalstr = $start_time_seconds . "-" . $end_time_seconds . "+" . $timeslot->getData('timeslot_id') . "=" . $start . ' to ' . $end ;
                        } elseif(strtotime($current_time) <= strtotime($cutoff)) {
                            $finalstr = $start_time_seconds . "-" . $end_time_seconds . "+" . $timeslot->getData('timeslot_id') . "=" . $start . ' to ' . $end;
                        }
                    } else {
                        $finalstr = $start_time_seconds . "-" . $end_time_seconds . "+" . $timeslot->getData('timeslot_id') . "=" . $start . ' to ' . $end;
                    }
                } else {
                    if (strtotime($post['date']) === strtotime('today')) {
                        if (strtotime($current_time) >= strtotime($start) && strtotime($current_time) <= strtotime($cutoff)) {
                            $finalstr .= "|" . $start_time_seconds . "-" . $end_time_seconds . "+" . $timeslot->getData('timeslot_id') . "=" . $start . ' to ' . $end;
                        } elseif(strtotime($current_time) <= strtotime($cutoff)) {
                            $finalstr .= "|" . $start_time_seconds . "-" . $end_time_seconds . "+" . $timeslot->getData('timeslot_id') . "=" . $start . ' to ' . $end;
                        }
                    } else {
                        $finalstr .= "|" . $start_time_seconds . "-" . $end_time_seconds . "+" . $timeslot->getData('timeslot_id') . "=" . $start . ' to ' . $end;
                    }
                }
            }
            if ($finalstr == "") {
                $finalstr = "tmp";
            }
            echo $finalstr;
        }
    }
}
