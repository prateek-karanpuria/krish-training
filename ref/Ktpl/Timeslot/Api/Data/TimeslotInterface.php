<?php


namespace Ktpl\Timeslot\Api\Data;

interface TimeslotInterface
{

    const STATE_ID = 'state_id';
    const MODULE_STATUS = 'module_status';
    const COUNTRY_ID = 'country_id';
    const CITY_ID = 'city_id';
    const TIMESLOT_ID = 'timeslot_id';
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const SHIPPING_CHARGE = 'shipping_charge';

    /**
     * Get timeslot_id
     * @return string|null
     */
    public function getTimeslotId();

    /**
     * Set timeslot_id
     * @param string $timeslotId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setTimeslotId($timeslotId);

    /**
     * Get country_id
     * @return string|null
     */
    public function getCountryId();

    /**
     * Set country_id
     * @param string $countryId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setCountryId($countryId);

    /**
     * Get state_id
     * @return string|null
     */
    public function getStateId();

    /**
     * Set state_id
     * @param string $stateId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setStateId($stateId);

    /**
     * Get city_id
     * @return string|null
     */
    public function getCityId();

    /**
     * Set city_id
     * @param string $cityId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setCityId($cityId);

    /**
     * Get start_date
     * @return string|null
     */
    public function getStartDate();

    /**
     * Set start_date
     * @param string $startDate
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setStartDate($startDate);

    /**
     * Get end_date
     * @return string|null
     */
    public function getEndDate();

    /**
     * Set end_date
     * @param string $endDate
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setEndDate($endDate);

    /**
     * Get shipping_charge
     * @return string|null
     */
    public function getShippingCharge();

    /**
     * Set shipping_charge
     * @param string $shippingCharge
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setShippingCharge($shippingCharge);

    /**
     * Get module_status
     * @return string|null
     */
    public function getModuleStatus();

    /**
     * Set module_status
     * @param string $moduleStatus
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     */
    public function setModuleStatus($moduleStatus);
}
