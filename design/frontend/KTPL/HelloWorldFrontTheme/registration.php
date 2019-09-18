<?php

use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
  ComponentRegistrar::THEME,
  'frontend/KTPL/HelloWorldTheme',
    __DIR__
);