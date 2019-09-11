<?php

namespace Training\Testimonial\Block;

use Magento\Framework\View\Element\Template;
use Training\Testimonial\Model\TestimonialFactory;

/**
 * Class ListView
 * @package Training\Testimonial\Block
 */
class ListView extends Template
{
    /**
     * @var TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * ListView constructor.
     * @param Template\Context $context
     * @param TestimonialFactory $testimonialFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        TestimonialFactory $testimonialFactory,
        array $data = []
    ) {
        $this->_testimonialFactory = $testimonialFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     * Called in all sliders phtml files (Home, Category View, Product View)
     */
    public function getTestimonials()
    {
        $testimonial = $this->_testimonialFactory->create();
        $collections = $testimonial->getCollection()->addFieldToFilter('deleted', 0)->setOrder('ratings', 'desc');

        return $collections;
    }

    /**
     * @return mixed
     * Called in testimonials list -> phtml file
     */
    public function getListView()
    {
        $testimonial = $this->_testimonialFactory->create();

        $collections = $testimonial->getCollection()->addFieldToFilter('deleted', 0)->setOrder('sort_order', 'desc')->setOrder('updated_on', 'desc');

        return $collections;
    }
}
