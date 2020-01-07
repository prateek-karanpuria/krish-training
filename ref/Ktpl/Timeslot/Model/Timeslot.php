<?php


namespace Ktpl\Timeslot\Model;

use Ktpl\Timeslot\Api\Data\TimeslotInterface;

class Timeslot extends \Magento\Framework\Model\AbstractModel implements TimeslotInterface
{

    protected $_eventPrefix = 'ktpl_timeslot_timeslot';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Ktpl\Timeslot\Model\ResourceModel\Timeslot::class);
    }

    /**
     * Get timeslot_id
     * @return string
     */
    public function getTimeslotId()
    {
        return $this->getData(self::TIMESLOT_ID);
    }

    /**
     * Set timeslot_id
     * @param string $timeslotId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setTimeslotId($timeslotId)
    {
        return $this->setData(self::TIMESLOT_ID, $timeslotId);
    }

    /**
     * Get country_id
     * @return string
     */
    public function getCountryId()
    {
        return $this->getData(self::COUNTRY_ID);
    }

    /**
     * Set country_id
     * @param string $countryId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setCountryId($countryId)
    {
        return $this->setData(self::COUNTRY_ID, $countryId);
    }

    /**
     * Get state_id
     * @return string
     */
    public function getStateId()
    {
        return $this->getData(self::STATE_ID);
    }

    /**
     * Set state_id
     * @param string $stateId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setStateId($stateId)
    {
        return $this->setData(self::STATE_ID, $stateId);
    }

    /**
     * Get city_id
     * @return string
     */
    public function getCityId()
    {
        return $this->getData(self::CITY_ID);
    }

    /**
     * Set city_id
     * @param string $cityId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setCityId($cityId)
    {
        return $this->setData(self::CITY_ID, $cityId);
    }

    /**
     * Get start_date
     * @return string
     */
    public function getStartDate()
    {
        return $this->getData(self::START_DATE);
    }

    /**
     * Set start_date
     * @param string $startDate
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setStartDate($startDate)
    {
        return $this->setData(self::START_DATE, $startDate);
    }

    /**
     * Get end_date
     * @return string
     */
    public function getEndDate()
    {
        return $this->getData(self::END_DATE);
    }

    /**
     * Set end_date
     * @param string $endDate
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setEndDate($endDate)
    {
        return $this->setData(self::END_DATE, $endDate);
    }

    /**
     * Get shipping_charge
     * @return string
     */
    public function getShippingCharge()
    {
        return $this->getData(self::SHIPPING_CHARGE);
    }

    /**
     * Set shipping_charge
     * @param string $shippingCharge
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setShippingCharge($shippingCharge)
    {
        return $this->setData(self::SHIPPING_CHARGE, $shippingCharge);
    }

    /**
     * Get module_status
     * @return string
     */
    public function getModuleStatus()
    {
        return $this->getData(self::MODULE_STATUS);
    }

    /**
     * Set module_status
     * @param string $moduleStatus
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setModuleStatus($moduleStatus)
    {
        return $this->setData(self::MODULE_STATUS, $moduleStatus);
    }
}
