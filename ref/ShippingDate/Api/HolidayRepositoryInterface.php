<?php


namespace Ktpl\ShippingDate\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface HolidayRepositoryInterface
{

    /**
     * Save Holiday
     * @param \Ktpl\ShippingDate\Api\Data\HolidayInterface $holiday
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Ktpl\ShippingDate\Api\Data\HolidayInterface $holiday
    );

    /**
     * Retrieve Holiday
     * @param string $holidayId
     * @return \Ktpl\ShippingDate\Api\Data\HolidayInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($holidayId);

    /**
     * Retrieve Holiday matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Ktpl\ShippingDate\Api\Data\HolidaySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Holiday
     * @param \Ktpl\ShippingDate\Api\Data\HolidayInterface $holiday
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Ktpl\ShippingDate\Api\Data\HolidayInterface $holiday
    );

    /**
     * Delete Holiday by ID
     * @param string $holidayId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($holidayId);
}
