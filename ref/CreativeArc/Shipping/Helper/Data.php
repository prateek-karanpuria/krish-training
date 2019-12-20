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
 * @author     Vinai Kopp <vinai@netzarbeiter.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class CreativeArc_Shipping_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Dump a variable to the logfile (defaults to groupscatalog.log)
	 *
	 * @param mixed $var
	 * @param string $file
	 */
	public function log($var, $file = null)
	{
		ob_start();
		print_r($var);
		$var = ob_get_contents();
		ob_end_clean();
		
		$file = isset($file) ? $file : 'shipping.log';
		
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') $var = str_replace("\n", "\r\n", $var);
		Mage::log($var, null, $file);
	}
}

