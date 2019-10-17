<?php

/**
 * Collection class
 */

namespace Training\AdminLoginLogs\Model\ResourceModel\AdminLoginLogs;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * class Collection
 * @package Training\AdminLoginLogs\Model\ResourceModel\AdminLoginLogs
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
    protected $_eventPrefix = 'training_adminLoginLogs_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'adminLoginLogs_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Training\AdminLoginLogs\Model\AdminLoginLogs', 'Training\AdminLoginLogs\Model\ResourceModel\AdminLoginLogs');
    }

}
