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
 * CreativeArc Shipping Canada Module
 * 
 * This shipping method implements the canada shipping rules.
 * Use the allowed countries settings in the backend to specify where this method
 * applies (i.e. Canada)
 * 
 * @author Vinai Kopp
 * @see Mage_Shipping_Model_Carrier_Tablerate
 */
class CreativeArc_Shipping_Model_Carrier_Canada
	extends CreativeArc_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
	/**
	 * Unique ID for this shipping module
	 *
	 * @var string
	 */
	protected $_code = 'ca_canada';
	
	/**
	 * Store for the resource model
	 *
	 * @var CreativeArc_Shipping_Model_Mysql4_Carrier_Canadarates
	 */
	protected $_resource;
	
	/**
	 * The max weight per box for the request zone
	 *
	 * @var float
	 */
	protected $_weightUpperLimit;
	
	/**
	 * Return the upper weigth limit for the destination of the given box
	 *
	 * @param CreativeArc_Shipping_Model_Box $box
	 * @return float
	 */
	protected function _getUpperWeightLimit(CreativeArc_Shipping_Model_Box $box)
	{
		if (! isset($this->_weightUpperLimit)) {
	    	if (! $this->_resource) {
	        	$this->_resource = Mage::getResourceModel('cashipping/carrier_canadarates');
	    	}
    		$this->_weightUpperLimit = $this->_resource->getUpperWeightLimit($box->getRequest());
		}
		return $this->_weightUpperLimit;
	}
	
	/**
	 * Return the total cost for this shipping
	 *
	 * @param Mage_Shipping_Model_Rate_Request $request
	 * @return float
	 */
    public function getRate(Mage_Shipping_Model_Rate_Request $request)
    {
    	if (! $this->_resource) {
        	$this->_resource = Mage::getResourceModel('cashipping/carrier_canadarates');
    	}
    	$totalCost = 0;
    	foreach ($this->getBoxes($request) as $box) {
        	$rate = $this->_resource->getRate($box);
        	$rate['cost'] += $box->getExtraShippingCharge(); 
			$totalCost += $rate['cost'];
    	}
        	
        // check the minimum shipping $ is set
        // CONFIRMED: minimun applies to total shipment, not to each each box
		if ($totalCost < ($min = $this->getConfigData('min_shipping')) && $min) {
			$totalCost = $min;
		}
        return $totalCost;
    }
    
	/**
	 * Return the shipping rates
	 *
	 * @param Mage_Shipping_Model_Request $request
	 * @return Mage_Shipping_Model_Rate_Result
	 */
	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
	    if (!$this->isActive()) return false;
	    
	    $result = $this->_getResult();
	    if ($method = $this->_getMethod($request)) {
			$result->append($method);
        }
        return $result;
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
	 * @param Mage_Shipping_Model_Rate_Request
	 * @return Mage_Shipping_Model_Rate_Result_Method
	 */
	protected function _getMethod(Mage_Shipping_Model_Rate_Request $request)
	{
		$rate = $this->getRate($request);
        if (empty($rate) && $rate < 0) return false;
        
        $shippingCost = $this->getFinalPriceWithHandlingFee($rate);
        
		$method = Mage::getModel('shipping/rate_result_method')
			->setCarrier($this->getCode())
			->setCarrierTitle($this->getConfigData('title'))
			->setMethod($this->getCode())
			->setMethodTitle($this->getConfigData('name'));
        
		// check for drop ship items
		if ($this->_hasDropShips()) {
			//$this->log(__CLASS__ . '::' . __METHOD__ . '() ... drop ship item found');
			Mage::register('contact_us_message', $this->getConfigData('contact_us_message_dropship'));
			$method->setMethodTitle($this->getConfigData('contact_us_title'))
				->setCost('0.00')
				->setPrice('0.00');
		}
		// handle max weight condition
		elseif ($this->_exceedsWeightLimit()) {
			//$this->log(__CLASS__ . '::' . __METHOD__ . '() ... max box weight exceeded');
			Mage::register('contact_us_message', $this->getConfigData('contact_us_message_weight'));
			$method->setMethodTitle($this->getConfigData('contact_us_title'))
				->setCost('0.00')
				->setPrice('0.00');
		}
		// no special conditions met, return "real" rate
		else {
			//$this->log(__CLASS__ . '::' . __METHOD__ . '() ... setting regular rate ' . $shippingCost);
			$method->setCost($shippingCost)
				->setPrice($this->getMethodPrice($shippingCost, $this->getCode()));
		}
		
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