<?php


namespace Reciproci\CommitApis\Api\Data;

interface ReciprociCancelApiSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get reciproci_cancel_api list.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface[]
     */
    public function getItems();

    /**
     * Set cancel_id list.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
