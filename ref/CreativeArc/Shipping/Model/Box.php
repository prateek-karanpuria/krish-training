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
 * CreativeArc Shipping Module Box
 * 
 */

class  CreativeArc_Shipping_Model_Box extends Varien_Object
{
	/**
	 * Array of items in this box
	 *
	 * @var array
	 */
	protected $_items = array();
	
	/**
	 * The quantities of each item in the box
	 * Array index is the product id of the item
	 *
	 * @var array
	 */
	protected $_quantities = array();
	
	/**
	 * Weight of the box
	 *
	 * @var float
	 */
	protected $_weight = 0;
	
	/**
	 * Extra shipping charge
	 * 
	 * @var float
	 */
	protected $_shipCharge = null;
	
	/**
	 * Flag if this box will be dropshipped or not
	 *
	 * @var boolean
	 */
	protected $_isDropShip = null;
	
	/**
	 * Adds an item to the box
	 *
	 * @param Mage_Sales_Model_Quote_Item $item
	 * @param integer $qty
	 * @return CreativeArc_Shipping_Model_Box
	 */
	public function addItem($item, $qty)
	{
		$this->_weight = 0;
		$this->_isDropShip = null;
		foreach ($this->_items as $_item) {
			if ($_item->getProductId() == $item->getProductId()) {
				$this->setQty($item, $this->getQty($item) + $qty);
				return $this;
			}
		}
		$this->_items[] = $item;
		$this->setQty($item, $qty);
		return $this;
	}
	
	/**
	 * Return all quote items in this box
	 *
	 * @return array
	 */
	public function getItems()
	{
		return $this->_items;
	}
	
	/**
	 * Set the quantity for a given item
	 *
	 * @param Mage_Sales_Model_Quote_Item $item
	 * @param integer|float $qty
	 */
	public function setQty(Mage_Sales_Model_Quote_Item $item, $qty)
	{
		$this->_quantities[$item->getProductId()] = $qty;
		return $this;
	}
	
	/**
	 * Return the quantity for a given item. If no item is specified, return the total number of items.
	 *
	 * @param Mage_Sales_Model_Quote_Item $item
	 * @return integer|float quantity
	 */
	public function getQty(Mage_Sales_Model_Quote_Item $item = null)
	{
		if (! isset($item)) {
			$qty = 0;
			foreach ($this->_quantities as $amount) $qty += $amount;
			return $qty;
		}
		if (! isset($this->_quantities[$item->getProductId()])) return 0;
		return $this->_quantities[$item->getProductId()];
	}
	
	/**
	 * Get the total weight of all items in the box
	 *
	 * @return float
	 */
	public function getWeight()
	{
		if (! $this->_weight) {
			foreach ($this->getItems() as $item) {
				$this->_weight += $item->getWeight() * $this->getQty($item);
			}	
		}
		return (float) $this->_weight;
	}
	
	/**
	 * Return the total extra ship_charge for this box
	 *
	 * @return float
	 */
	public function getExtraShippingCharge()
	{
		if (!isset($this->_shipCharge)) {
			$this->_shipCharge = 0;
			foreach ($this->getItems() as $item) {
				if ($charge = $item->getProduct()->getShipCharge()){
					$this->_shipCharge += $charge * $this->getQty($item);
				} 
			}
		}
		return (float) $this->_shipCharge;
	}
	
	/**
	 * Check if any items in the box have the drop_ship flag set
	 *
	 * @return boolean
	 */
	public function isDropShip()
	{
		if (!isset($this->_isDropShip)) {
			foreach ($this->getItems() as $item) {
				if ($item->getProduct()->getDropShip()) {
					return $this->_isDropShip = true;
				}
			}
			$this->_isDropShip = false;
		}
		return $this->_isDropShip;
	}
}