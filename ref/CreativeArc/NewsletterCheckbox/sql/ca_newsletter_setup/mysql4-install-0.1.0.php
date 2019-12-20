<?php

$this->startSetup();
$this->addAttribute('quote', 'ca_newsletter', array('type' => 'int', 'visible_on_front' => 0, 'visible' => 1));
$this->addAttribute('order', 'ca_newsletter', array('type' => 'int', 'visible_on_front' => 0, 'visible' => 1));
$this->endSetup();