<?php


namespace Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi;

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
            \Reciproci\CommitApis\Model\ReciprociOrdersApi::class,
            \Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi::class
        );
    }
}
