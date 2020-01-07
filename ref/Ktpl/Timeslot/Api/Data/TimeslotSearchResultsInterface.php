<?php


namespace Ktpl\Timeslot\Api\Data;

interface TimeslotSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Timeslot list.
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface[]
     */
    public function getItems();

    /**
     * Set country_id list.
     * @param \Ktpl\Timeslot\Api\Data\TimeslotInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
