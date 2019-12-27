<?php


namespace Reciproci\CommitApis\Api\Data;

interface ReciprociOrdersApiSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get reciproci_orders_api list.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface[]
     */
    public function getItems();

    /**
     * Set order_id list.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
