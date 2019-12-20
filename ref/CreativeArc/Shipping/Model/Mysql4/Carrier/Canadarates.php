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
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Canada shipping table rates
 *
 * @category   CreativeArc
 * @package    CreativeArc_Shipping
 * @author     Vinai Kopp <vinai@netzarbeiter.com>
 */
class CreativeArc_Shipping_Model_Mysql4_Carrier_Canadarates extends Mage_Core_Model_Mysql4_Abstract
{
	/**
	 * Set the resource type
	 */
	protected function _construct()
	{
		$this->_init('cashipping/canadarates', 'pk');
	}

	/**
	 * Fetch the rate from the table depending on destination and weight
	 *
	 * @param CreativeArc_Shipping_Model_Box $box
	 * @return array
	 */
	public function getRate(CreativeArc_Shipping_Model_Box $box)
	{
		$read = $this->_getReadAdapter();
		
		$request = $box->getRequest();

		$select = $read->select()->from($this->getMainTable());
		$select->where(
			$read->quoteInto(" website_id = ?", $request->getWebsiteId()) .
			$read->quoteInto(" AND zip_from <= ?", $request->getDestPostcode()) .
			$read->quoteInto(" AND zip_to >= ?", $request->getDestPostcode()) .
			$read->quoteInto(" AND weight_from <= ?", $box->getWeight()) .
			$read->quoteInto(" AND weight_to > ?", $box->getWeight())
		);
		$select->order('price DESC');
		$select->order('cost ASC');
		$select->limit(1);

		$row = $read->fetchRow($select);
		return $row;
	}

	/**
	 * Return the weight that exeeds the limit
	 *
	 * @param Mage_Shipping_Model_Rate_Request $request
	 * @return float
	 */
	public function getUpperWeightLimit(Mage_Shipping_Model_Rate_Request $request)
	{
		$read = $this->_getReadAdapter();
		$select = $read->select()->from($this->getMainTable());
		$select->where(
			$read->quoteInto(" website_id = ?", $request->getWebsiteId()) .
			$read->quoteInto(" AND zip_from <= ?", $request->getDestPostcode()) .
			$read->quoteInto(" AND zip_to >= ?", $request->getDestPostcode())
		);
		$select->order('weight_from DESC');
		$select->limit(1);

		$row = $read->fetchRow($select);
		if (!$row)
			throw new Exception(
				Mage::helper('cashipping')->__("No max weight found in canadarates table (website %s, zip %s)",
				$request->getWebsiteId(), $request->getDestPostcode()
			));
		return (float) $row['weight_from'];
	}

	/**
	 * Load the canada table rates into the database
	 *
	 * @param Mage_Core_Model_Config_Data $backendModel
	 */
	public function uploadAndImport(Mage_Core_Model_Config_Data $backendModel)
	{
		$csvFileZones = $_FILES["groups"]["tmp_name"]["ca_canada"]["fields"]["canadazones"]["value"];
		$csvFileRates = $_FILES["groups"]["tmp_name"]["ca_canada"]["fields"]["canadarates"]["value"];
		$exceptions = array();

		if (!empty($csvFileRates) && !empty($csvFileZones)) {

			$websiteId = $backendModel->getScopeId();
			$zones = $rates = array();

			$csv = trim(file_get_contents($csvFileZones));
			if (!empty($csv)) {
				$csvLines = explode("\n", $csv);
				$csvLine = array_shift($csvLines);
				$csvLine = $this->_getCsvValues($csvLine);
				if (count($csvLine) < 4) {
					$exceptions[] = Mage::helper('cashipping')->__('Invalid Canada Zones File Format on line 1');
				} else {
					foreach ($csvLines as $k => $csvLine)
					{
						$lineNum = $k+2;
						$csvLine = $this->_getCsvValues($csvLine);
						if (count($csvLine) > 0 && count($csvLine) < 4) {
							$exceptions[] = Mage::helper('cashipping')->__('Invalid Canada Zones File Format on line %d', $lineNum);
						} else {
							list($dummy_field, $zip_from, $zip_to, $zone) = $csvLine;
							if (! $zone || $zone != intval($zone)) {
								$exceptions[] = Mage::helper('cashipping')->__('Invalid Zone "%s" in Zones File on line %d', $zone, $lineNum);
							}
							elseif (! $zip_from) {
								$exceptions[] = Mage::helper('cashipping')->__('Invalid lower Zip "%s" in Zones File on line %d', $zip_from, $lineNum);
							}
							elseif (! $zip_to) {
								$exceptions[] = Mage::helper('cashipping')->__('Invalid higher  Zip "%s" in Zones File on line %d', $zip_to, $lineNum);
							}
							else {
								if (! isset($zones[$zone])) $zones[$zone] = array(array($zip_from, $zip_to));
								else $zones[$zone][] = array($zip_from, $zip_to);
							}
						}
					}
					//Mage::helper('cashipping')->log($zones);
					if (count($zones) == 0) {
						$exceptions[] = Mage::helper('cashipping')->__('No Canada Zones found in Csv File');
					}
					else {
						$csv = trim(file_get_contents($csvFileRates));
						if (!empty($csv)) {
							$csvLines = explode("\n", $csv);
							$csvLine = array_shift($csvLines);
							$csvLine = $this->_getCsvValues($csvLine);
							if (count($csvLine) < 4) {
								$exceptions[] = Mage::helper('cashipping')->__('Invalid Canada Rates File Format on line 1');
							} else {
								foreach ($csvLines as $k => $csvLine)
								{
									$lineNum = $k+2;
									$csvLine = $this->_getCsvValues($csvLine);
									if (count($csvLine) > 0 && count($csvLine) < 5) {
										$exceptions[] = Mage::helper('cashipping')->__('Invalid Canada Rates File Format on line %d', $lineNum);
									} else {
										list($dummy_field, $zone, $weight_from, $weight_to, $cost) = $csvLine;
										$weight_from = $this->_fixDecimalSeperator($weight_from);
										$weight_to = $this->_fixDecimalSeperator($weight_to);
										$cost = $this->_fixDecimalSeperator($cost);
										if (! isset($zones[$zone])) {
											$exceptions[] = Mage::helper('cashipping')->__('Invalid Zone "%s" in Rates File on line %d', $zone, $lineNum);
										}
										elseif (! $this->_isPositiveDecimalNumber($weight_from)) {
											$exceptions[] = Mage::helper('cashipping')->__('Invalid lower Weight "%s" in Rates File on line %d', $weight_from, $lineNum);
										}
										elseif (! $this->_isPositiveDecimalNumber($weight_to)) {
											$exceptions[] = Mage::helper('cashipping')->__('Invalid heigher Weight "%s" in Rates File on line %d', $weight_to, $lineNum);
										}
										elseif (! $this->_isPositiveDecimalNumber($cost)) {
											$exceptions[] = Mage::helper('cashipping')->__('Invalid Cost "%s" in Rates File on line %d', $cost, $lineNum);
										}
										else {
											foreach ($zones[$zone] as $zip_zone) {
												$rates[] = array(
	                								'website_id' => $websiteId,
	                								'zip_from' => $zip_zone[0],
	                								'zip_to' => $zip_zone[1],
	                								'zone_id' => $zone,
	                								'weight_from' => $weight_from,
	                								'weight_to' => $weight_to,
	                								'price' => $cost,
	                								'cost' => $cost,
												);
											}
										}
									}
								} // end foreach line in the rates file
							} // end rates header field count matches
						} // end rates file not empty
						else {
							$exceptions[] = Mage::helper('cashipping')->__('Empty Rates Csv File');
						}
					} // end if zones found in zones file
				} // end zones header field count matches
				if (empty($exceptions)) {
					//Mage::helper('cashipping')->log($rates);
					$write = $this->_getWriteAdapter();
					$table = Mage::getSingleton('core/resource')->getTableName('cashipping/canadarates');

					$write->delete($table, $write->quoteInto('website_id = ?', $websiteId));

					foreach ($rates as $rate) {
						try {
							$write->insert($table, $rate);
						} catch (Exception $e) {
							$exceptions[] = Mage::helper('cashipping')->__('Duplicate Row #%s (Website "%s", lower Zip "%s", higher Zip "%s", lower Weight "%s", heigher Weight "%s")',
							$rate['website_id'], $rate['zip_from'], $rate['zip_to'], $rate['weight_from'], $rate['weight_to'], $rate['cost']
							);
						}
					}
				}
			} // end zones file not empty
			else {
				$exceptions[] = Mage::helper('cashipping')->__('Empty Zones Csv File');
			}
		} // end if files submitted
		if (!empty($exceptions)) {
			throw new Exception( Mage::helper('cashipping')->__("Error(s) during import of Canada shipping rates:\n") . implode("\n", $exceptions) );
		}
	}

	/**
	 * Get the fields from a line of csv
	 *
	 * @param string $string
	 * @param string $separator
	 * @return array
	 */
	protected function _getCsvValues($string, $separator=",")
	{
		$elements = explode($separator, trim($string));
		for ($i = 0; $i < count($elements); $i++) {
			$nquotes = substr_count($elements[$i], '"');
			if ($nquotes %2 == 1) {
				for ($j = $i+1; $j < count($elements); $j++) {
					if (substr_count($elements[$j], '"') > 0) {
						// Put the quoted string's pieces back together again
						array_splice($elements, $i, $j-$i+1, implode($separator, array_slice($elements, $i, $j-$i+1)));
						break;
					}
				}
			}
			if ($nquotes > 0) {
				// Remove first and last quotes, then merge pairs of quotes
				$qstr =& $elements[$i];
				$qstr = substr_replace($qstr, '', strpos($qstr, '"'), 1);
				$qstr = substr_replace($qstr, '', strrpos($qstr, '"'), 1);
				$qstr = str_replace('""', '"', $qstr);
			}
			$elements[$i] = trim($elements[$i]);
		}
		return $elements;
	}

	/**
	 * Check if the given value is a positive decimal number
	 *
	 * @param string|integer|float $n
	 * @return boolean
	 */
	protected function _isPositiveDecimalNumber($n)
	{
		return preg_match ("/^[0-9]+(\.[0-9]*)?$/", strval($n));
	}

	/**
	 * Sometimes the decimal seperator is seperated as a comma instead of a . into csv
	 * This is a quick fix for that.
	 *
	 * @param string|integer|float $value
	 * @return string
	 */
	protected function _fixDecimalSeperator($value)
	{
		return str_replace(',', '.', strval($value));
	}

}
