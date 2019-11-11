<?php


namespace Ktpl\ShippingDate\Model\ResourceModel;

class Holiday extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ktpl_shippingdate_holiday', 'holiday_id');
    }
}
