<?php


namespace Reciproci\CommitApis\Model\ResourceModel;

class ReciprociDeliveryApi extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('reciproci_commitapis_reciproci_delivery_api', 'reciproci_delivery_api_id');
    }
}
