<?php

/**
 * Model class of AdminLoginLogs module
 */

namespace Training\AdminLoginLogs\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * class AdminLoginLogs class
 * @package Training\AdminLoginLogs\Model
 */
class AdminLoginLogs extends AbstractModel implements IdentityInterface
{
    /**
     * @var string
     */
    const CACHE_TAG = 'training_adminloginlogs';

    /**
     * @var string
     */
    protected $_cacheTag = 'training_adminloginlogs';

    /**
     * @var string
     */
    protected $_eventPrefix = 'training_adminloginlogs';

    /**
     * This method is required by implementing IdentityInterface
     * which is meant for caching the model data.
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('Training\AdminLoginLogs\Model\ResourceModel\AdminLoginLogs');
    }
}
