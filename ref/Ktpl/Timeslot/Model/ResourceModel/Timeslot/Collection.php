<?php


namespace Ktpl\Timeslot\Model\ResourceModel\Timeslot;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Ktpl\Timeslot\Model\Timeslot::class,
            \Ktpl\Timeslot\Model\ResourceModel\Timeslot::class
        );
    }
}
