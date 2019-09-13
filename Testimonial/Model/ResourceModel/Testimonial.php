<?php

namespace Training\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * Class Testimonial
 * @package Training\Testimonial\Model\ResourceModel
 */
class Testimonial extends AbstractDb
{
    /**
     * Testimonial constructor
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * For overidding parent constructor of AbstractResource
     */
    protected function _construct()
    {
        $this->_init('training_testimonials', 'id');
    }
}
