<?php


namespace Reciproci\CommitApis\Model\ResourceModel;

class ReciprociCancelApi extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('reciproci_commitapis_reciproci_cancel_api', 'reciproci_cancel_api_id');
    }
}
