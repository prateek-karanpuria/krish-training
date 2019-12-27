<?php


namespace Reciproci\CommitApis\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ReciprociOrdersApiRepositoryInterface
{

    /**
     * Save reciproci_orders_api
     * @param \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface $reciprociOrdersApi
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface $reciprociOrdersApi
    );

    /**
     * Retrieve reciproci_orders_api
     * @param string $reciprociOrdersApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reciprociOrdersApiId);

    /**
     * Retrieve reciproci_orders_api matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete reciproci_orders_api
     * @param \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface $reciprociOrdersApi
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface $reciprociOrdersApi
    );

    /**
     * Delete reciproci_orders_api by ID
     * @param string $reciprociOrdersApiId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reciprociOrdersApiId);
}
