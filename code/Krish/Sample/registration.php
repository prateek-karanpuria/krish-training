<?php
/**
 * File: registration.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github       https://github.com/maciejslawik
 */

//This registers the module in autoloading
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Krish_Sample',
    __DIR__
);
