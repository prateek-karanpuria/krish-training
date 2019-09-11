<?php

namespace Training\Testimonial\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\Testimonial\Api\Data\TestimonialInterface;

interface TestimonialRepositoryInterface
{
    /**
     * @param int $id
     * @return \Training\Testimonial\Api\Data\TestimonialInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Training\Testimonial\Api\Data\TestimonialInterface $testimonial
     * @return \Training\Testimonial\Api\Data\TestimonialInterface
     */
    public function save(TestimonialInterface $testimonial);

    /**
     * @param \Training\Testimonial\Api\Data\TestimonialInterface $testimonial
     * @return void
     */
    public function delete(TestimonialInterface $testimonial);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Testimonial\Api\Data\TestimonialSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
