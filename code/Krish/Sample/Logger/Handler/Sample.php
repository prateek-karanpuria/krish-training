<?php
/**
 * File: Sample.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

//Simple log handler implementation. It defines the the file to write the logs.
//You can extends the base class further to customize e.g. the way the logs
//are saved.

/**
 * Class Sample
 * @package Krish\Sample\Logger\Handler
 */
class Sample extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/ktpl/sample.log';

    /**
     * @var int
     */
    protected $loggerType = Logger::DEBUG;
}
