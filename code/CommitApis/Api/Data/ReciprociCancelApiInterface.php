<?php


namespace Reciproci\CommitApis\Api\Data;

interface ReciprociCancelApiInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const RECIPROCI_CANCEL_API_ID = 'reciproci_cancel_api_id';
    const REQUEST_DATA = 'request_data';
    const RESPONSE_DATA = 'response_data';
    const ORDER_ID = 'order_id';
    const SKIP = 'skip';
    const CANCEL_ID = 'cancel_id';
    const STATUS = 'status';

    /**
     * Get reciproci_cancel_api_id
     * @return string|null
     */
    public function getReciprociCancelApiId();

    /**
     * Set reciproci_cancel_api_id
     * @param string $reciprociCancelApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setReciprociCancelApiId($reciprociCancelApiId);

    /**
     * Get cancel_id
     * @return string|null
     */
    public function getCancelId();

    /**
     * Set cancel_id
     * @param string $cancelId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setCancelId($cancelId);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociCancelApiExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Reciproci\CommitApis\Api\Data\ReciprociCancelApiExtensionInterface $extensionAttributes
    );

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId();

    /**
     * Set order_id
     * @param string $orderId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setUpdatedAt($updatedAt);
}
