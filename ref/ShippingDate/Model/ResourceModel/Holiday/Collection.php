<?php


namespace Ktpl\ShippingDate\Model\ResourceModel\Holiday;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'holiday_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ktpl\ShippingDate\Model\Holiday::class,
            \Ktpl\ShippingDate\Model\ResourceModel\Holiday::class
        );
    }
}
