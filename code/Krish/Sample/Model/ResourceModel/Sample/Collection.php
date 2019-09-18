<?php
/**
 * File: Collection.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Model\ResourceModel\Sample;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

//This is the CRUD Collection

/**
 * Class Collection
 * @package Krish\Sample\Model\ResourceModel
 */
class Collection extends AbstractCollection
{
    /**
     * This function is responsible for telling Magento about the model
     * and resource model for the collection class.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Krish\Sample\Model\Sample',
            'Krish\Sample\Model\ResourceModel\Sample'
        );
    }
}
