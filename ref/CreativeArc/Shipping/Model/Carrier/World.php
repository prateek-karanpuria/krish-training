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
/**
 * CreativeArc Shipping World Module
 * 
 * This shipping method simply returns a cost and price of zero, and displays
 * the 'Contact us' message.
 * Use the allowed countries settings in the backend to specify where this method
 * applies.
 * 
 * @author Vinai Kopp
 */
class CreativeArc_Shipping_Model_Carrier_World
	extends CreativeArc_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
	/**
	 * Unique ID for this shipping module
	 *
	 * @var string
	 */
	protected $_code = 'ca_world';

	/**
	 * Return the shipping rates
	 *
	 * @param Mage_Shipping_Model_Request $request
	 * @return Mage_Shipping_Model_Rate_Result
	 */
	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
	    if (!$this->isActive()) return false;
	    
		return $this->_getResult()->append($this->_getMethod());
	}
	
	/**
	 * Return the shipping rate result object
	 *
	 * @return Mage_Shipping_Model_Rate_Result
	 */
	protected function _getResult()
	{
		$result = Mage::getModel('shipping/rate_result');
		return $result;
	}
	
	/**
	 * Return the shipping method object
	 *
	 * @return Mage_Shipping_Model_Rate_Result_Method
	 */
	protected function _getMethod()
	{
		$method = Mage::getModel('shipping/rate_result_method')
			->setCarrier($this->getCode())
			->setCarrierTitle($this->getConfigData('title'));
		
		$method->setMethod($this->getCode())
			->setMethodTitle($this->getConfigData('method_title'))
			
			->setCost('0.00')
			->setPrice('0.00');
		
        /*PATCH TO MAKE SURE WE ALWAYS HAVE LATEST CONTACT US MESSAGE - atheotsky*/
        if (Mage::registry('contact_us_message')) {
            Mage::unregister('contact_us_message');
        }
		Mage::register('contact_us_message', $this->getConfigData('contact_us_message'));
		return $method;
	}
	
	/**
	 * Get allowed shipping methods.
	 * Part of Mage_Shipping_Model_Carrier_Interface
	 *
	 * @return array
	 * @see Mage_Shipping_Model_Carrier_Interface
	 */
	public function getAllowedMethods()
	{
        $methods = array($this->getCode() => $this->getConfigData('title'));
        return $methods;
	}
	
}
