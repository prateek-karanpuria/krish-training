<?php
declare(strict_types=1);

/**
 * File: MessageInterface.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Api\Amqp;

/**
 * Interface MessageInterface
 * @package Krish\Sample\Api\Amqp
 */
interface MessageInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void;

    /**
     * @return string
     */
    public function getMessage(): string;
}
