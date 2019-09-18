<?php
/**
 * File: AmqpMessage.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Logger\Handler;

use Magento\Framework\Logger\Handler\Base;
use Monolog\Logger;

/**
 * Class AmqpMessage
 * @package Krish\Sample\Logger\Handler
 */
class AmqpMessage extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/ktpl/amqp.log';

    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;
}
