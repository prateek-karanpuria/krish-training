<?php
/**
 * File: SampleSearchResultInterface.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

//This is an interface for getList results

/**
 * Interface SampleSearchResultInterface
 * @package Krish\Sample\Api\Data
 */
interface SampleSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Krish\Sample\Api\Data\SampleInterface[]
     */
    public function getItems();

    /**
     * @param \Krish\Sample\Api\Data\SampleInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
