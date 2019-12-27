<?php


namespace Reciproci\CommitApis\Api\Data;

interface ReciprociOrdersApiInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const RECIPROCI_ORDERS_API_ID = 'reciproci_orders_api_id';
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const REQUEST_DATA = 'request_data';
    const RESPONSE_DATA = 'response_data';
    const ORDER_ID = 'order_id';
    const SKIP = 'skip';
    const STATUS = 'status';

    /**
     * Get reciproci_orders_api_id
     * @return string|null
     */
    public function getReciprociOrdersApiId();

    /**
     * Set reciproci_orders_api_id
     * @param string $reciprociOrdersApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     */
    public function setReciprociOrdersApiId($reciprociOrdersApiId);

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     */
    public function setOrderId($orderId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiExtensionInterface $extensionAttributes
    );

    /**
     * Get request_data
     * @return string|null
     */
    public function getRequestData();

    /**
     * Set request_data
     * @param string $requestData
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     */
    public function setUpdatedAt($updatedAt);
}
