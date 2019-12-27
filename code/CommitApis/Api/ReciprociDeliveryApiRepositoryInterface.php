<?php


namespace Reciproci\CommitApis\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ReciprociDeliveryApiRepositoryInterface
{

    /**
     * Save reciproci_delivery_api
     * @param \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface $reciprociDeliveryApi
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface $reciprociDeliveryApi
    );

    /**
     * Retrieve reciproci_delivery_api
     * @param string $reciprociDeliveryApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reciprociDeliveryApiId);

    /**
     * Retrieve reciproci_delivery_api matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete reciproci_delivery_api
     * @param \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface $reciprociDeliveryApi
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface $reciprociDeliveryApi
    );

    /**
     * Delete reciproci_delivery_api by ID
     * @param string $reciprociDeliveryApiId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reciprociDeliveryApiId);
}
