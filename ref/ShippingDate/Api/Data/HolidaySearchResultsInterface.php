<?php


namespace Ktpl\ShippingDate\Api\Data;

interface HolidaySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Holiday list.
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface[]
     */
    public function getItems();

    /**
     * Set holiday_name list.
     * @param \Ktpl\ShippingDate\Api\Data\HolidayInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
