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
 * CreativeArc Shipping Module Abstract
 * 
 * This abstract calss implements a coouple of shared methods
 * 
 * @author Vinai Kopp
 */
abstract class CreativeArc_Shipping_Model_Carrier_Abstract
	extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
	/**
	 * Array containiing the CreativeArc_Shipping_Model_Box objects of this shipping
	 *
	 * @var array
	 * @see self::getBoxes()
	 */
	protected $_boxes = array();
	
	/**
	 * Store flag if a box exceeds the upper weight limit
	 *
	 * @var boolean
	 */
	protected $_exceedsWeightLimit = null;
	
	/**
	 * Make sure the correct data is returned... you never know
	 *
	 * @return string
	 */
	public function getCode()
	{
		return $this->_code;
	}
	
	/**
	 * Check if a rates request contains any dropship items
	 *
	 * @param Mage_Shipping_Model_Rate_Request
	 * @return boolean
	 */
	protected function _hasDropShipItems(Mage_Shipping_Model_Rate_Request $request)
	{
		foreach ($request->getAllItems() as $item) {
			if ($item->getProduct()->getDropShip()) return true;
		}
		return false;
	}
	
	/**
	 * Checks if any boxes contain dropship items
	 *
	 * @param Mage_Shipping_Model_Rate_Request $request
	 * @return boolean
	 */
	protected function _hasDropShips(Mage_Shipping_Model_Rate_Request $request = null)
	{
		foreach ($this->getBoxes($request) as $box) {
			if ($box->isDropShip()) return true;
		}
		return false;
	}
	
	/**
	 * Checks if the rate cost indicates the weight of the box exceeds the max limit
	 *
	 * @return boolean
	 */
	protected function _exceedsWeightLimit()
	{
		if (! isset($this->_exceedsWeightLimit)) {
	    	foreach ($this->getBoxes() as $box) {
	    		if ($box->getWeight() >= $this->_getUpperWeightLimit($box)) {
	    			$this->_exceedsWeightLimit = true;
	    			break;
	    		}
	    	}
	    	if (! isset($this->_exceedsWeightLimit)) $this->_exceedsWeightLimit = false;
		}
		return $this->_exceedsWeightLimit;
	}
	
	/**
	 * Debug method shortcut
	 *
	 * @param mixed $var
	 */
	protected function log($var)
	{
		Mage::helper('cashipping')->log($var);
	}
	
    /**
     * Return an array, every index is a CreativeArc_Shipping_Model_Box object.
     * 
     * ACHTUNG: this method works differently then
     * Mage_Shipping_Model_Carrier_Abstract::getTotalNumOfBoxes()
     *
     * @param Mage_Shipping_Model_Rate_Request
     * @return array
     */
    public function getBoxes(Mage_Shipping_Model_Rate_Request $request = null)
    {
    	if (!$this->_boxes && isset($request))
    		$this->_packBoxes($request);
    	
    	return $this->_boxes;
    }
    
    /**
     * Build the array of boxes for this shippment
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return CreativeArc_Shipping_Model_Carrier_Abstract
     */
    protected function _packBoxes(Mage_Shipping_Model_Rate_Request $request)
    {
    	/**
    	 * @var array The array containing the boxes
    	 */
    	$this->_boxes = array();
        
        /**
         * @var array An array with boxes that aren't full with max-per-box items, for max-per-box = zero items
         */
        $boxes_with_space_left = array();
        
        /**
         * @var array remember which items are boxed, so they don't get packed more then once
         */
        $items_packed = array();
    
    	// first, pack the max-per-box items
    	foreach ($request->getAllItems() as $item) {
    		/*
    		Mage::helper('cashipping')->log(sprintf('item %s, children: %d, parent: %d, parent sku: %s, qty: %s',
    			$item->getSku(), $item->getHasChildren(), (bool) $item->getParentItem(),
    			($item->getParentItem() ? $item->getParentItem()->getSku() : ''),
    			$item->getQty())
    		);
    		*/
    		
    		if ($item->getHasChildren()) continue;
    		$qty = $item->getParentItem() ? $item->getParentItem()->getQty() : $item->getQty();
    		
    		// load the extra shipping attributes
    		$product = $item->getProduct()->load($item->getProductId());
    		
    		if ($max_per_box = $product->getMaxPerBox()) {
    			// first, add boxes we can fill completly
    			$numBoxes = floor($qty / $max_per_box);
    			for ($i = 0; $i < $numBoxes; $i++) {
    				$this->_boxes[] = Mage::getModel('cashipping/box')
    					->setRequest($request)
    					->addItem($item, $max_per_box);
    			}
    			// add the last box with the remaining quantity
    			if ($remaining = ($qty % $max_per_box)) {
    				$box = Mage::getModel('cashipping/box')
    					->setRequest($request)
    					->addItem($item, $remaining);
    				$this->_boxes[] = $box;
    				$boxes_with_space_left[] = $box;
    			}
    			
    			// remember this item is boxed
    			$items_packed[] = $item->getProductId();
    		}
    	}
    	
        // next, pack the drop ship items
    	foreach ($request->getAllItems() as $item) {
    		
    		if ($item->getHasChildren()) continue;
    		$qty = $item->getParentItem() ? $item->getParentItem()->getQty() : $item->getQty();
    		
    		if (in_array($item->getProductId(), $items_packed)) continue;
        	// we can safely assume this is no max-per-box item, otherwise it would have been packed allready
    		if ($item->getProduct()->getDropShip()) {
    			$this->_boxes[] = $box = Mage::getModel('cashipping/box')
    				->setRequest($request)
    				->addItem($item, $qty);
    			
    			// remember this item is boxed
    			$items_packed[] = $item->getProductId();
    		}
    	}
    	
    	// lastly, pack the remaing items without max-per-box value (all non-dropship)
    	$last_box = null;
    	foreach ($request->getAllItems() as $item) {
    		
    		if ($item->getHasChildren()) continue;
    		$qty = $item->getParentItem() ? $item->getParentItem()->getQty() : $item->getQty();
    		
    		if (in_array($item->getProductId(), $items_packed)) continue;
    		if (! isset($last_box)) {
    			if (count($boxes_with_space_left) > 0) {
    				// find the box with the most space left to add these items to
    				foreach ($boxes_with_space_left as $box) {
    					if (! isset($last_box) || $box->getWeight() < $last_box->getWeight()) {
    						$last_box = $box;
    					}
    				}
    			} else {
    				$last_box = Mage::getModel('cashipping/box')
    					->setRequest($request);
    				$this->_boxes[] = $last_box;
    			}
    		}
    		$last_box->addItem($item, $qty);
    		// remember this item is boxed
    		$items_packed[] = $item->getProductId();
    	}
    	//Mage::helper('cashipping')->log("num boxes packed: " . count($this->_boxes));
    	
    	return $this;
    }
}