<?php


namespace Ktpl\Timeslot\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TimeslotRepositoryInterface
{

    /**
     * Save Timeslot
     * @param \Ktpl\Timeslot\Api\Data\TimeslotInterface $timeslot
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ktpl\Timeslot\Api\Data\TimeslotInterface $timeslot
    );

    /**
     * Retrieve Timeslot
     * @param string $timeslotId
     * @return \Ktpl\Timeslot\Api\Data\TimeslotInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($timeslotId);

    /**
     * Retrieve Timeslot matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ktpl\Timeslot\Api\Data\TimeslotSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Timeslot
     * @param \Ktpl\Timeslot\Api\Data\TimeslotInterface $timeslot
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ktpl\Timeslot\Api\Data\TimeslotInterface $timeslot
    );

    /**
     * Delete Timeslot by ID
     * @param string $timeslotId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($timeslotId);
}
