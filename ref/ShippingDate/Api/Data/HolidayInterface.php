<?php


namespace Ktpl\ShippingDate\Api\Data;

interface HolidayInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const WEBSITE_ID = 'website_id';
    const HOLIDAY_ID = 'holiday_id';
    const HOLIDAY_DATE = 'holiday_date';
    const HOLIDAY_NAME = 'holiday_name';
    const ENABLED = 'enabled';

    /**
     * Get holiday_id
     * @return string|null
     */
    public function getHolidayId();

    /**
     * Set holiday_id
     * @param string $holidayId
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setHolidayId($holidayId);

    /**
     * Get holiday_name
     * @return string|null
     */
    public function getHolidayName();

    /**
     * Set holiday_name
     * @param string $holidayName
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setHolidayName($holidayName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ktpl\ShippingDate\Api\Data\HolidayExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Ktpl\ShippingDate\Api\Data\HolidayExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ktpl\ShippingDate\Api\Data\HolidayExtensionInterface $extensionAttributes
    );

    /**
     * Get holiday_date
     * @return string|null
     */
    public function getHolidayDate();

    /**
     * Set holiday_date
     * @param string $holidayDate
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setHolidayDate($holidayDate);

    /**
     * Get enabled
     * @return string|null
     */
    public function getEnabled();

    /**
     * Set enabled
     * @param string $enabled
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setEnabled($enabled);

    /**
     * Get website_id
     * @return string|null
     */
    public function getWebsiteId();

    /**
     * Set website_id
     * @param string $websiteId
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setWebsiteId($websiteId);
}
