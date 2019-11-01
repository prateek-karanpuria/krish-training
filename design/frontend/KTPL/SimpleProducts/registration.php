<?php

/**
 * Frontend theme registration file
 */

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::THEME,
    'frontend/KTPL/SimpleProducts',
    __DIR__
);
