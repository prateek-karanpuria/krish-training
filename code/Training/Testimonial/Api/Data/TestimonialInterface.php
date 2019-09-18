<?php

namespace Training\Testimonial\Api\Data;

/**
 * TestimonialInterface interface
 */
interface TestimonialInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const TESTIMONIAL_ID          = 'id';
    const TESTIMONIAL_STORE_ID    = 'store_id';
    const TESTIMONIAL_USER_ID     = 'user_id';
    const TESTIMONIAL_PRODUCT_ID  = 'product_id';
    const TESTIMONIAL_NAME        = 'name';
    const TESTIMONIAL_EMAIL       = 'email';
    const TESTIMONIAL_MESSAGE     = 'message';
    const TESTIMONIAL_IMAGE       = 'image';
    const TESTIMONIAL_RATINGS     = 'ratings';
    const TESTIMONIAL_SORT_ORDER  = 'sort_order';
    const TESTIMONIAL_IS_APPROVED = 'is_approved';
    const TESTIMONIAL_USER_IP     = 'user_ip';
    const TESTIMONIAL_USER_AGENT  = 'user_agent';
    const TESTIMONIAL_ADDED_ON    = 'added_on';
    const TESTIMONIAL_UPDATED_ON  = 'updated_on';
    const TESTIMONIAL_DELETED     = 'deleted';

    public function getId();
    public function setId($id);
    public function getStoreId();
    public function setStoreId($storeId);
    public function getProductId();
    public function setProductId($productId);
    public function getName();
    public function setName($name);
    public function getEmail();
    public function setEmail($email);
    public function getMessage();
    public function setMessage($message);
    public function getImage();
    public function setImage($image);
    public function getRatings();
    public function setRatings($ratings);
    public function getSortOrder();
    public function setSortOrder($sortOrder);
    public function getIsApproved();
    public function setIsApproved($isApproved);
    public function getUserIp();
    public function setUserIp($userIp);
    public function getUserAgent();
    public function setUserAgent($userAgent);
    public function getCreatedAt();
    public function setCreatedAt($createdAt);
    public function getUpdatedOn();
    public function setUpdatedOn($updatedOn);
}
