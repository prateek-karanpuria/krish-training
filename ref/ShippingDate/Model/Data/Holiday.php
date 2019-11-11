<?php


namespace Ktpl\ShippingDate\Model\Data;

use Ktpl\ShippingDate\Api\Data\HolidayInterface;

class Holiday extends \Magento\Framework\Api\AbstractExtensibleObject implements HolidayInterface
{

    /**
     * Get holiday_id
     * @return string|null
     */
    public function getHolidayId()
    {
        return $this->_get(self::HOLIDAY_ID);
    }

    /**
     * Set holiday_id
     * @param string $holidayId
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setHolidayId($holidayId)
    {
        return $this->setData(self::HOLIDAY_ID, $holidayId);
    }

    /**
     * Get holiday_name
     * @return string|null
     */
    public function getHolidayName()
    {
        return $this->_get(self::HOLIDAY_NAME);
    }

    /**
     * Set holiday_name
     * @param string $holidayName
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setHolidayName($holidayName)
    {
        return $this->setData(self::HOLIDAY_NAME, $holidayName);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Ktpl\ShippingDate\Api\Data\HolidayExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Ktpl\ShippingDate\Api\Data\HolidayExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Ktpl\ShippingDate\Api\Data\HolidayExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get holiday_date
     * @return string|null
     */
    public function getHolidayDate()
    {
        return $this->_get(self::HOLIDAY_DATE);
    }

    /**
     * Set holiday_date
     * @param string $holidayDate
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setHolidayDate($holidayDate)
    {
        return $this->setData(self::HOLIDAY_DATE, $holidayDate);
    }

    /**
     * Get enabled
     * @return string|null
     */
    public function getEnabled()
    {
        return $this->_get(self::ENABLED);
    }

    /**
     * Set enabled
     * @param string $enabled
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setEnabled($enabled)
    {
        return $this->setData(self::ENABLED, $enabled);
    }

    /**
     * Get website_id
     * @return string|null
     */
    public function getWebsiteId()
    {
        return $this->_get(self::WEBSITE_ID);
    }

    /**
     * Set website_id
     * @param string $websiteId
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     */
    public function setWebsiteId($websiteId)
    {
        return $this->setData(self::WEBSITE_ID, $websiteId);
    }
}
