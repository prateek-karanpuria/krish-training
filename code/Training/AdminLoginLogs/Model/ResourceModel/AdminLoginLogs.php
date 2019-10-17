<?php

/**
 * AdminLoginLogs ResourceModel class
 */

namespace Training\AdminLoginLogs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * xlass AdminLoginLogs
 * @package Training\AdminLoginLogs\Model\ResourceModel
 */
class AdminLoginLogs extends AbstractDb
{
    /**
     * AdminLoginLogs constructor
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * For overidding parent constructor of AbstractResource
     */
    protected function _construct()
    {
        $this->_init('training_admin_login_logs', 'id');
    }
}
