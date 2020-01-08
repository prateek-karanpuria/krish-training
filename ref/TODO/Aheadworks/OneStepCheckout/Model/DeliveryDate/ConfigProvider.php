<?php
/**
 * Copyright 2018 aheadWorks. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Aheadworks\OneStepCheckout\Model\DeliveryDate;

use Aheadworks\OneStepCheckout\Model\Config;
use Aheadworks\OneStepCheckout\Model\Config\Source\DeliveryDate\DisplayOption;

/**
 * Class ConfigProvider
 * @package Aheadworks\OneStepCheckout\Model\DeliveryDate
 */
class ConfigProvider
{
    /**
     * @var Config
     */
    private $config;
    private $timezone;
    private $date;

    /**
     * @param Config $config
     */
    public function __construct(Config $config,\Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,\Magento\Framework\Stdlib\DateTime\DateTime $date)
    {
        $this->config = $config;
        $this->timezone = $timezone;
        $this->date = $date;
    }

    /**
     * Get delivery date options config
     *
     * @return array
     */
    public function getConfig()
    {
        $currentDate = $this->date->gmtDate();
        $store_date = $this->timezone->date();
        $time = $store_date->format('Y-m-d H:i:s');
        // echo $currentDate;exit;
        // echo strtotime($time);
        // $targetTime = 
        // exit;
        $date = $this->timezone->date(new \DateTime($currentDate))->format('m/d/Y');
        return [
            'isEnabled' => $this->config->getDeliveryDateDisplayOption() != DisplayOption::NO,
            'currentCheckoutDate' => $date,
            'dateRestrictions' => [
                'weekdays' => $this->config->getDeliveryDateAvailableWeekdays(),
                'nonDeliveryPeriods' => $this->config->getNonDeliveryPeriods(), // todo: to current timezone
                'minOrderDeliveryPeriod' => $this->config->getMinOrderDeliveryPeriod()
            ]
        ];
    }
}
