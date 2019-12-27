<?php


namespace Reciproci\CommitApis\Model\ResourceModel;

class ReciprociOrdersApi extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('reciproci_commitapis_reciproci_orders_api', 'reciproci_orders_api_id');
    }
}
