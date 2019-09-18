<?php

namespace Training\Testimonial\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TestimonialSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get data list
     *
     * @return Data\TestimonialInterface
     */
    public function getItems();

    /**
     * Set data list
     *
     * @param Data\TestimonialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
