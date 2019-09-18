<?php
/**
 * File: ConfigProviderInterface.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Api;

//Module API for providing data from the configuration of the module

/**
 * Interface ConfigProviderInterface
 * @package Krish\Sample\Api
 */
interface ConfigProviderInterface
{
    /**
     * @return bool
     */
    public function getBoolValue(): bool;

    /**
     * @return string
     */
    public function getTextValue(): string;
}
