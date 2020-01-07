<?php


namespace Ktpl\Timeslot\Model\ResourceModel;

class Timeslot extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ktpl_timeslot_timeslot', 'timeslot_id');
    }
}
