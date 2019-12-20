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
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   CreativeArc
 * @package    CreativeArc_Shipping
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Source model for ups shipping pickup options
 *
 * @category   CreativeArc
 * @package    CreativeArc_Shipping
 * @author     Vinai Kopp <vinai@netzarbeiter.com>
 */
class CreativeArc_Shipping_Model_System_Config_Shipping_Source_Usa_Unitofmeasure
{
    public function toOptionArray()
    {
        $usa = Mage::getSingleton('cashipping/carrier_usa');
        $arr = array(
        	'LBS' => Mage::helper('cashipping')->__('Pounds'),
        	'KGS' => Mage::helper('cashipping')->__('Kilograms'),
        );
        return $arr;
    }
}