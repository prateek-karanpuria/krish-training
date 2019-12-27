<?php


namespace Reciproci\CommitApis\Model\Data;

use Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface;

class ReciprociOrdersApi extends \Magento\Framework\Api\AbstractExtensibleObject implements ReciprociOrdersApiInterface
{

    /**
     * Get reciproci_orders_api_id
     * @return string|null
     */
    public function getReciprociOrdersApiId()
    {
        return $this->_get(self::RECIPROCI_ORDERS_API_ID);
    }

    /**
     * Set reciproci_orders_api_id
     * @param string $reciprociOrdersApiId
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     */
    public function setReciprociOrdersApiId($reciprociOrdersApiId)
    {
        return $this->setData(self::RECIPROCI_ORDERS_API_ID, $reciprociOrdersApiId);
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
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
     * @return \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
