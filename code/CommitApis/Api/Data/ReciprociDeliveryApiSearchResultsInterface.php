<?php


namespace Reciproci\CommitApis\Api\Data;

interface ReciprociDeliveryApiSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get reciproci_delivery_api list.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface[]
     */
    public function getItems();

    /**
     * Set shipment_id list.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
