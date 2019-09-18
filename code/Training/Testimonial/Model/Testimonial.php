<?php

namespace Training\Testimonial\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Training\Testimonial\Api\Data\TestimonialInterface;

/**
 * Testimonial class
 * @package Training\Testimonial\Model
 */
class Testimonial extends AbstractModel implements IdentityInterface, TestimonialInterface
{
    /**
     * @var string
     */
    const CACHE_TAG = 'training_testimonial_testimonial';

    /**
     * @var string
     */
    protected $_cacheTag = 'training_testimonial_testimonial';

    /**
     * @var string
     */
    protected $_eventPrefix = 'training_testimonial_testimonial';

    /**
     * This method is required by implementing IdentityInterface
     * which is meant for caching the model data.
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Training\Testimonial\Model\ResourceModel\Testimonial');
    }

    public function getId()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_ID);
    }

    public function setId($testimonialId)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_ID, $testimonialId);
    }

    public function getStoreId()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_ID);
    }

    public function setStoreId($storeId)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_STORE_ID, $storeId);
    }

    public function getProductId()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_PRODUCT_ID);
    }

    public function setProductId($productId)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_PRODUCT_ID, $productId);
    }

    public function getName()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_NAME);
    }

    public function setName($name)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_NAME, $name);
    }

    public function getEmail()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_EMAIL, $email);
    }

    public function getMessage()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_MESSAGE);
    }

    public function setMessage($message)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_MESSAGE, $message);
    }

    public function getImage()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_IMAGE);
    }

    public function setImage($image)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_IMAGE, $image);
    }

    public function getRatings()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_RATINGS);
    }

    public function setRatings($ratings)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_RATINGS, $ratings);
    }

    public function getSortOrder()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_SORT_ORDER);
    }

    public function setSortOrder($sortOrder)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_SORT_ORDER, $sortOrder);
    }

    public function getIsApproved()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_IS_APPROVED);
    }

    public function setIsApproved($isApproved)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_IS_APPROVED, $isApproved);
    }

    public function getUserIp()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_USER_IP);
    }

    public function setUserIp($userIp)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_USER_IP, $userIp);
    }

    public function getUserAgent()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_USER_AGENT);
    }

    public function setUserAgent($userAgent)
    {
        return $this->setData(TestimonialInterface::TESTIMONIAL_USER_AGENT, $userIp);
    }

    public function getCreatedAt()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_CREATED_AT, $createdAt);
    }

    public function getUpdatedOn()
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_UPDATED_ON);
    }

    public function setUpdatedOn($updatedOn)
    {
        return $this->getData(TestimonialInterface::TESTIMONIAL_UPDATED_ON, $updatedOn);
    }
}
