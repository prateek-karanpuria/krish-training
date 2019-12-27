<?php


namespace Reciproci\CommitApis\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ReciprociCancelApiRepositoryInterface
{

    /**
     * Save reciproci_cancel_api
     * @param \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface $reciprociCancelApi
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface $reciprociCancelApi
    );

    /**
     * Retrieve reciproci_cancel_api
     * @param string $reciprociCancelApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($reciprociCancelApiId);

    /**
     * Retrieve reciproci_cancel_api matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete reciproci_cancel_api
     * @param \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface $reciprociCancelApi
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface $reciprociCancelApi
    );

    /**
     * Delete reciproci_cancel_api by ID
     * @param string $reciprociCancelApiId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($reciprociCancelApiId);
}
