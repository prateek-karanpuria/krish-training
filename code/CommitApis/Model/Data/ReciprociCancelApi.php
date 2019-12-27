<?php


namespace Reciproci\CommitApis\Model\Data;

use Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface;

class ReciprociCancelApi extends \Magento\Framework\Api\AbstractExtensibleObject implements ReciprociCancelApiInterface
{

    /**
     * Get reciproci_cancel_api_id
     * @return string|null
     */
    public function getReciprociCancelApiId()
    {
        return $this->_get(self::RECIPROCI_CANCEL_API_ID);
    }

    /**
     * Set reciproci_cancel_api_id
     * @param string $reciprociCancelApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setReciprociCancelApiId($reciprociCancelApiId)
    {
        return $this->setData(self::RECIPROCI_CANCEL_API_ID, $reciprociCancelApiId);
    }

    /**
     * Get cancel_id
     * @return string|null
     */
    public function getCancelId()
    {
        return $this->_get(self::CANCEL_ID);
    }

    /**
     * Set cancel_id
     * @param string $cancelId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setCancelId($cancelId)
    {
        return $this->setData(self::CANCEL_ID, $cancelId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociCancelApiExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Reciproci\CommitApis\Api\Data\ReciprociCancelApiExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->_get(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $orderId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get request_data
     * @return string|null
     */
    public function getRequestData()
    {
        return $this->_get(self::REQUEST_DATA);
    }

    /**
     * Set request_data
     * @param string $requestData
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setRequestData($requestData)
    {
        return $this->setData(self::REQUEST_DATA, $requestData);
    }

    /**
     * Get response_data
     * @return string|null
     */
    public function getResponseData()
    {
        return $this->_get(self::RESPONSE_DATA);
    }

    /**
     * Set response_data
     * @param string $responseData
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setResponseData($responseData)
    {
        return $this->setData(self::RESPONSE_DATA, $responseData);
    }

    /**
     * Get skip
     * @return string|null
     */
    public function getSkip()
    {
        return $this->_get(self::SKIP);
    }

    /**
     * Set skip
     * @param string $skip
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setSkip($skip)
    {
        return $this->setData(self::SKIP, $skip);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
