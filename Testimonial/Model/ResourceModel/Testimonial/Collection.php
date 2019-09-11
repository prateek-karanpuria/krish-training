<?php

namespace Training\Testimonial\Model\ResourceModel\Testimonial;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Training\Testimonial\Model\ResourceModel\Testimonial
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'training_testimonial_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'testimonial_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Training\Testimonial\Model\Testimonial', 'Training\Testimonial\Model\ResourceModel\Testimonial');
    }

}
