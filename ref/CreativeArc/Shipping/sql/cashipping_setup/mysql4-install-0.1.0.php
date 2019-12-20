<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   CreativeArc
 * @package    CreativeArc_Shipping
 * @copyright  Copyright (c) 2008 Vinai Kopp http://netzarbeiter.com/
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * @var $this CreativeArc_Shipping_Model_Entity_Setup
 * @see Mage_Eav_Model_Entity_Setup
 */
$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS `{$this->getTable('cashipping_canadarates')}`;
CREATE TABLE `{$this->getTable('cashipping_canadarates')}` (
  `pk` int(10) unsigned NOT NULL auto_increment,
  `website_id` int(11) NOT NULL default '0',
  `zip_from` varchar(10) NOT NULL default '',
  `zip_to` varchar(10) NOT NULL default '',
  `zone_id` varchar(2) NOT NULL default '',
  `weight_from` decimal(12,4) NOT NULL default '0',
  `weight_to` decimal(12,4) NOT NULL default '0',
  `price` decimal(12,4) NOT NULL default '0.0000',
  `cost` decimal(12,4) NOT NULL default '0.0000',
  PRIMARY KEY  (`pk`),
  UNIQUE KEY `dest_country` (`website_id`,`zip_from`,`zip_to`, `weight_from`, `weight_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();


// EOF