<?php
/**
 * File: Sample.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

//This is the CRUD ResourceModel

/**
 * Class Sample
 * @package Krish\Sample\Model\ResourceModel
 */
class Sample extends AbstractDb
{
    /**
     * This method is responsible for telling Magento which table should be used
     * for model persistence and which column is the ID.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ktpl_sample', 'entity_id');
    }
}
