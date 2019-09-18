<?php

use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::THEME,
    'adminhtml/KTPL/HelloWorldTheme',
    __DIR__
);
