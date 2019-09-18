<?php
/**
 * File: SampleSearchResult.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Model\Data;

use Krish\Sample\Api\Data\SampleSearchResultInterface;
use Magento\Framework\Api\SearchResults;

//Concrete implementation of SampleSearchResultInterface.
//There is no need to implement anything, all necessary methods are in parent
//class and the interface provides PHPDocs required for correct class handling by Magento.

/**
 * Class SampleSearchResult
 * @package Krish\Sample\Model\Data
 */
class SampleSearchResult extends SearchResults implements SampleSearchResultInterface
{

}
