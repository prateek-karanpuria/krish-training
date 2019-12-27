<?php


namespace Reciproci\CommitApis\Api\Data;

interface ReciprociDeliveryApiInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const REQUEST_DATA = 'request_data';
    const RESPONSE_DATA = 'response_data';
    const RECIPROCI_DELIVERY_API_ID = 'reciproci_delivery_api_id';
    const ORDER_ID = 'order_id';
    const SKIP = 'skip';
    const SHIPMENT_ID = 'shipment_id';
    const STATUS = 'status';

    /**
     * Get reciproci_delivery_api_id
     * @return string|null
     */
    public function getReciprociDeliveryApiId();

    /**
     * Set reciproci_delivery_api_id
     * @param string $reciprociDeliveryApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setReciprociDeliveryApiId($reciprociDeliveryApiId);

    /**
     * Get shipment_id
     * @return string|null
     */
    public function getShipmentId();

    /**
     * Set shipment_id
     * @param string $shipmentId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setShipmentId($shipmentId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiExtensionInterface $extensionAttributes
    );

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setOrderId($orderId);

    /**
     * Get request_data
     * @return string|null
     */
    public function getRequestData();

    /**
     * Set request_data
     * @param string $requestData
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setRequestData($requestData);

    /**
     * Get response_data
     * @return string|null
     */
    public function getResponseData();

    /**
     * Set response_data
     * @param string $responseData
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setResponseData($responseData);

    /**
     * Get skip
     * @return string|null
     */
    public function getSkip();

    /**
     * Set skip
     * @param string $skip
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setSkip($skip);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setStatus($status);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface
     */
    public function setUpdatedAt($updatedAt);
}
