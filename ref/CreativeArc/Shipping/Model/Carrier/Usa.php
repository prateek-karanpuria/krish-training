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
 * CreativeArc Shipping Usa UPS Module
 * 
 * This shipping method implements the usa shipping rules.
 * Use the allowed countries settings in the backend to specify where this method
 * applies (i.e. Usa)
 * 
 * @author Vinai Kopp
 */
class CreativeArc_Shipping_Model_Carrier_Usa
	extends CreativeArc_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
	const USA_COUNTRY_ID = 'US';
	const PUERTORICO_COUNTRY_ID = 'PR';
	const PUERTORICO_REGION_ID = 'PR';
	const ALASKA_REGION_ID = 'AK';
	const HAWAII_REGION_ID = 'HI';
	
	const API_METHOD_XML = 'xml';
	const API_METHOD_CGI = 'cgi';
	
	protected $_upper_states = array(
		self::PUERTORICO_REGION_ID,
		self::ALASKA_REGION_ID,
		self::HAWAII_REGION_ID,
	);
	
	/**
	 * Unique ID for this shipping module
	 *
	 * @var string
	 */
	protected $_code = 'ca_usa';
	
	/**
	 * The total extra shipping charge of alll items in the request
	 *
	 * @var float
	 */
	protected $_extraShippingChargeTotal = null;
	
	/**
	 * Which method to use to query the ups api
	 * Valid values are self::API_METHOD_XML or self::API_METHOD_CGI
	 * Use self::API_METHOD_XML! :) The cgi code is here only as reference.
	 *
	 * @var string
	 */
	protected $_upsApiMethod = self::API_METHOD_XML;
	
	/**
	 * UPS cgi gateway url
	 *
	 * @var string
	 */
    protected $_cgiGatewayUrl = 'http://www.ups.com:80/using/services/rave/qcostcgi.cgi';
    
    /**
     * UPS xml gateway url
     *
     * @var string
     */
    protected $_xmlGatewayUrl = 'https://www.ups.com/ups.app/xml/Rate';
    
    /**
     * Array of error messages
     *
     * @var array
     */
    protected $_errorMessages = array();
    
    /**
     * The minimun weight to request a quote from ups.
     * If a box is lighter, use this value instead of the real box weight in the request.
     *
     * @var unknown_type
     */
	protected $_minRequestWeight = 0.1; 
    
    protected function _clearErrorMessages()
    {
    	$this->_errorMessages = array();
    }
    
    protected function _addErrorMessage($msg)
    {
    	$this->_errorMessages[] = $msg;
    }
    
    protected function _getErrorMessages()
    {
    	return implode("\n", $this->_errorMessages);
    }
    
    /**
     * Set the ups CGI gateway url
     *
     * @param string $url
     * @return CreativeArc_Shipping_Model_Carrier_Usa
     */
    public function setCgiGatewayUrl($url)
    {
    	$this->_cgiGatewayUrl = $url;
    	return $this;
    }
    
    /**
     * Return the ups CGI gateway url
     *
     * @return string
     */
    public function getCgiGatewayUrl()
    {
    	return $this->_cgiGatewayUrl;
    }
    
    /**
     * Return the ups XML gateway url
     *
     * @return string
     */
    public function getXmlGatewayUrl()
    {
    	return $this->_xmlGatewayUrl;
    }
    
    /**
     * Return true if the request destination address is within the lower 48 states 
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return boolean
     */
    protected function _destAddrIsInLowerStates(Mage_Shipping_Model_Rate_Request $request)
    {
    	return ! $this->_destAddrIsInUpperStates($request);
    }
    
    
    /**
     * Return true if the request destination address is NOT within the lower 48 states 
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return boolean
     */
    protected function _destAddrIsInUpperStates(Mage_Shipping_Model_Rate_Request $request)
    {
    	if ($request->getDestCountryId() == self::PUERTORICO_COUNTRY_ID) {
    		$request->setDestRegionCode(self::PUERTORICO_REGION_ID);
    	}
    	return in_array($request->getDestRegionCode(), $this->_upper_states);
    }
    
    /**
     * Return the rates returned from the ups gateway summed up for all boxes
     *
     * @param Mage_Shipping_Model_Rate_Request $box
     * @param string $code
     * @return float|integer|boolean
     */
    protected function _getMethodRateTotalCost(Mage_Shipping_Model_Rate_Request $request, $methodCode)
    {
    	$this->_clearErrorMessages();
    	$totalCost = 0;
    	foreach ($this->getBoxes($request) as $box) {
    		if (! $box->getWeight() > 0) continue;
    		$cost = $this->_getUpsCostForBox($box, $methodCode);
    		if (! $cost) return false;
    		$totalCost += $cost;
    	}
    	return $totalCost;
    }
    
    /**
     * Build a xml string from a nested hash
     *
     * @param array $array
     * @param string $rootNode - if the returned xml should be enclosed in a roor node, set the element name here
     * @return string
     */
    protected function _arrayToXml($array, $rootNode = null)
    {
    	$xml = '';
    	foreach ($array as $key => $value)
    	{
    		if (is_array($value)) $xml .= sprintf('<%s>%s</%s>', $key, $this->_arrayToXml($value), $key);
    		else $xml .= sprintf('<%s>%s</%s>', $key, $value, $key);
    	}
    	if (isset($rootNode))
    	{
    		$xml = sprintf('<%s>%s</%s>', $rootNode, $xml, $rootNode);
    	}
    	return $xml;
    }
    
    /**
     * Get the rate for one box from the ups gateway
     *
     * @param CreativeArc_Shipping_Model_Box $box
     * @param string $methodCode
     * @return float|boolean
     */
    protected function _getUpsCostForBox(CreativeArc_Shipping_Model_Box $box, $methodCode)
    {
    	if (($rates = $box->getRates()) && isset($rates[$methodCode])) return $rates[$methodCode];
    	
	    try {
	    	if ($this->_upsApiMethod == self::API_METHOD_XML)
	    	{
	    		$rates = $this->_getXmlApiRates($box, $methodCode);
	    	}
	    	else
	    	{
	    		$rates = $this->_getCgiApiRates($box, $methodCode);
	    	}
        } catch (Exception $e) {
        	$this->_addErrorMessage($e->getMessage());
            $responseBody = '';
        }
    	
        //$this->log($rates);
        $box->setRates($rates);
        if (! isset($rates[$methodCode])) {
        	$this->_addErrorMessage(Mage::helper('cashipping')->__('UPS Rate "%s" not found.', $methodCode));
        	return false;
        }
        return $rates[$methodCode];
    }
    
    protected function _getCgiApiRates(CreativeArc_Shipping_Model_Box $box, $methodCode)
    {
    	$params = $this->_prepareCgiRequestParams($box, $methodCode);
        //$this->log($params);
        $url = $this->getCgiGatewayUrl();
        $client = new Zend_Http_Client();
        $client->setUri($url);
        $client->setConfig(array('maxredirects' => 0, 'timeout' => 15));
        $client->setParameterGet($params);
        $response = $client->request();
        $responseBody = $response->getBody();
        
        //$this->log("Response: \n" . $responseBody);
        $rates = $this->_parseCgiResponse($responseBody);
        return $rates;
    }
    
    protected function _getXmlApiRates(CreativeArc_Shipping_Model_Box $box, $methodCode)
    {
    	$params = $this->_prepareXmlRequestParams($box, $methodCode);
        //$this->log('params: ' . $params);
        $url = $this->getXmlGatewayUrl();
        /* in case no ssl support is compiled into php
        $client = new Zend_Http_Client();
        $client->setMethod(Zend_Http_Client::POST);
        $client->setUri($url);
        $client->setConfig(array('maxredirects' => 0, 'timeout' => 15));
        $client->setRawData($params);
        $response = $client->request();
        $responseBody = $response->getBody();
        */
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_TIMEOUT, 15);
            $responseBody = curl_exec($ch);
            if (curl_errno($ch)) Mage::throwException(curl_error($ch));
        } catch (Exception $e) {
        	$this->log("Curl Error: \n" . $e->getMessage());
            $responseBody = '';
        }
        
        //$this->log("Response: \n" . $responseBody);
        $rates = $this->_parseXmlResponse($responseBody);
        return $rates;
    }
    
    /**
     * Prepare the parameters for the request to the upsg ateway
     *
     * @param CreativeArc_Shipping_Model_Box $box
     * @param string $methodCode
     * @return array
     */
    protected function _prepareCgiRequestParams(CreativeArc_Shipping_Model_Box $box, $methodCode)
    {
    	$request = $box->getRequest();
    	
		if (! ($origCountry = $request->getOrigCountry())) {
			$origCountry = Mage::getStoreConfig('shipping/origin/country_id', $this->getStore());
		}
		if (! ($origPostCode = $request->getOrigPostcode())) {
			$origPostCode = Mage::getStoreConfig('shipping/origin/postcode', $this->getStore());
		}
		if (! ($origCity = $request->getOrigCity())) {
			$origCity = Mage::getStoreConfig('shipping/origin/city', $this->getStore());
		}
		if (! ($destCountry = $request->getDestCountryId())) {
			$destCountry = self::USA_COUNTRY_ID;
		}
		if ($destCountry == self::USA_COUNTRY_ID && ($request->getDestPostcode() == '00912'
			|| $request->getDestRegionCode() == self::PUERTORICO_COUNTRY_ID))
		{
			$destCountry = self::PUERTORICO_COUNTRY_ID;
		}
		if (! ($pickup = $request->getUpsPickup())) {
			$pickup = $this->getConfigData('pickup');
		}
		if (false !== $this->getPickupOptions($pickup)) {
				$pickup = urlencode($this->getPickupOptions($pickup, 'label'));
		}
		if (! ($container = $request->getUpsContainer())) {
			$container = $this->getConfigData('container');
		}
		if (false !== $this->getContainerOptions($container)) {
				$container = $this->getContainerOptions($container, 'code');
		}
		if (! ($destType = $request->getUpsDestType())) {
			$destType = $this->getConfigData('dest_type');
		}
		if (false !== $this->getDestTypeOptions($destType)) {
				$destType = $this->getDestTypeOptions($destType, 'code');
		}
		if (! ($unit = $request->getUpsUnitMeasure())) {
			$unit = $this->getConfigData('unit_of_measure');
		}
		$destPostCode = $request->getDestPostcode();
		$weight = $box->getWeight();
		
		if ($weight < $this->_minRequestWeight) $weight = $this->_minRequestWeight;
		
        
        $params = array(
            'accept_UPS_license_agreement' => 'yes',
            '10_action'      => 4, // 3 = single, 4 = all
            '13_product'     => $methodCode,
            '14_origCountry' => $origCountry,
            '15_origPostal'  => $origPostCode,
            'origCity'       => $origCity,
            '19_destPostal'  => $destPostCode,
            '22_destCountry' => $destCountry,
            '23_weight'      => $weight,
            '47_rate_chart'  => $pickup,
            '48_container'   => $container,
            '49_residential' => $destType,
            'weight_std'     => strtolower($unit),
        );
        
        return $params;
    }
    
    protected function _prepareXmlRequestParams(CreativeArc_Shipping_Model_Box $box, $methodCode)
    {
    	$cgiParams = $this->_prepareCgiRequestParams($box, $methodCode);
    	$xmlHeader = '<?xml version="1.0" ?>';
    	$request = '';
    	
    
    
		if (! ($pickup = $box->getRequest()->getUpsPickup())) {
			$pickup = $this->getConfigData('pickup');
		}
		if (false !== $this->getPickupOptions($pickup)) {
			$pickup = $this->getPickupOptions($pickup, 'code');
		}
    	
    	$params = array(
    		'AccessLicenseNumber' => $this->getConfigData('ups_api_key'),
    		'UserId' => $this->getConfigData('ups_api_user'),
    		'Password' => $this->getConfigData('ups_api_pass'),
    	);
		
    	$request .= $xmlHeader . "\n" . $this->_arrayToXml($params, 'AccessRequest') . "\n";
    	$params = array(
    		'Request' => array(
    			'RequestAction' => 'Rate',
    			'RequestOption' => 'Shop', // Rate or Shop (Shop = return rates for all ups products)
    		),
    		'Pickup' => array(
    			'Code' => $pickup,
    		),
    		'CustomerClassification' => array(
    			'Code' => $this->getCustomerClassificationOptions($this->getConfigData('customer_classification'), 'code'),
    		),
    		'Shipment' => array(
    			'Shipper' => array(
    				'Address' => array(
    					'City' => $cgiParams['origCity'],
    					'PostalCode' => $cgiParams['15_origPostal'],
    					'CountryCode' => $cgiParams['14_origCountry'],
    				),
    			),
    			'ShipTo' => array(
    				'Address' => array(
    					'PostalCode' => $cgiParams['19_destPostal'],
    					'CountryCode' => $cgiParams['22_destCountry'],
    					// Add 'ResidentialAddressIndicator' here later if applicable
    				),
    			),
    			'ShipFrom' => array(
    				'Address' => array(
    					'City' => $cgiParams['origCity'],
    					'PostalCode' => $cgiParams['15_origPostal'],
    					'CountryCode' => $cgiParams['14_origCountry'],
    				),
    			),
    			'Package' => array(
    				'PackagingType' => array(
    					'Code' => $cgiParams['48_container'],
    				),
    				'PackageWeight' => array(
    					'UnitOfMeasurement' => array(
    						'Code' => $cgiParams['weight_std'],
    					),
    					'Weight' => $cgiParams['23_weight'],
    				),
    			),
    		),
    	);
    	if ($cgiParams['49_residential'] == $this->getDestTypeOptions('RES', 'code'))
    	{
    		// add empty residential indicator flag node
    		$params['Shipment']['ShipTo']['Address']['ResidentialAddressIndicator'] = '';
    	}
    	if ($n = $this->getConfigData('ups_shipper_number'))
    	{
    		// add empty negotiated rates indicator flag node
    		$params['Shipment']['Shipper']['ShipperNumber'] = $n;
    		$params['Shipment']['RateInformation'] = array(
    			'NegotiatedRatesIndicator' => '',
    		);
    	}
    	$request .= $xmlHeader . "\n" . $this->_arrayToXml($params, 'RatingServiceSelectionRequest') . "\n";
    	return $request;
    }
    
    protected function _strPadTrim($str, $length, $pad = ' ', $padType = null)
    {
    	if (! isset($padType)) $padType = STR_PAD_LEFT;
    	return substr(str_pad($str, $length, $pad, $padType), 0, $length);
    }
    
    /**
     * Parse the ups xml respponse
     *
     * @param string $response
     * @return array
     */
    protected function _parseXmlResponse($response)
    {
    	$rates = array();
    	$allowedMethods = $this->getAllowedMethods();
    	$xml = new Varien_Simplexml_Config();
    	$xml->loadString($response);
    	//$this->log($xml->getXpath("//RatingServiceSelectionResponse"));
    	$arr = $xml->getXpath("//RatingServiceSelectionResponse/Response/ResponseStatusCode/text()");
    	$success = (int)$arr[0][0];
    	if ($success === 1)
    	{
    		$arr = $xml->getXpath("//RatingServiceSelectionResponse/RatedShipment");
    		foreach ($arr as $shipElement)
    		{
    			//$this->log($shipElement);
    			$code = (string)$shipElement->Service->Code;
    			if ($methodCode = $this->_mapUpsMethodCodeToValidMagentoMethod($code))
    			{
    				$rates[$methodCode] = floatval($shipElement->TotalCharges->MonetaryValue);
    			}
    		}
    	}
    	else
    	{
    		$arr = $xml->getXpath("//RatingServiceSelectionResponse/Response/Error/ErrorDescription/text()");
    		Mage::throwException((string)$arr[0][0]);
    	}
    	return $rates;
    }
    
    /**
     * Parse the ups cgi response
     *
     * @param string $response
     * @return array
     */
    protected function _parseCgiResponse($response)
    {
    	$rates = array();
    	$allowedMethods = $this->getAllowedMethods();
    	$errorTitle = Mage::helper('cashipping')->__('Unknown error');
    	foreach (explode("\n", trim($response)) as $line) {
    		$fields = explode('%', trim($line));
    		switch ($resultCode = substr($fields[0], -1)) {
    			case 5:
    				$errorTitle = $r[1];
    				break;
    			case 3:
    			case 4:
    				if (isset($allowedMethods[$fields[1]])) {
    					$rates[$fields[1]] = $fields[8];
    				}
    				break;
    			case 6:
    				if (isset($allowedMethods[$fields[3]])) {
    					$rates[$fields[3]] = $fields[10];
    				}
    				break;
    		}
    	}
    	return $rates;
    }
    
    /**
     * Get the extra shipping charge above the rate ups gives for all boxes together.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @param integer $perItem
     * @return float|integer
     */
    protected function _getExtraCharges(Mage_Shipping_Model_Rate_Request $request, $perItem)
    {
    	$extraCharge = 0;
    	foreach ($this->getBoxes($request) as $box) {
    		$extraCharge += $box->getExtraShippingCharge();
    		$extraCharge += $box->getQty() * $perItem;
    	}
    	return $extraCharge;
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
	    
	    foreach ($this->_getMethods($request) as $method) {
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
	 * Create and return a Mage_Shipping_Model_Rate_Result_Error object
	 *
	 * @param string $methodCode
	 * @param string $methodTitle
	 * @return Mage_Shipping_Model_Rate_Result_Error
	 */
	protected function _getMethodError($methodCode, $methodTitle)
	{
		return Mage::getModel('shipping/rate_result_error')
				->setCarrier($this->getCode())
				->setCarrierTitle($this->getConfigData('title'))
				->setMethod($methodCode)
				->setMethodTitle($methodTitle)
				->setErrorMessage($this->_getErrorMessages())
				->setCost('0.00')
				->setPrice('0.00');
	}
	
	/**
	 * Create and return a Mage_Shipping_Model_Rate_Result_Method object
	 *
	 * @param string $methodCode
	 * @param string $methodTitle
	 * @param float $cost
	 * @param float $price
	 * @return Mage_Shipping_Model_Rate_Result_Method
	 */
	protected function _getMethod($methodCode, $methodTitle, $cost, $price)
	{
		return Mage::getModel('shipping/rate_result_method')
				->setCarrier($this->getCode())
				->setCarrierTitle($this->getConfigData('title'))
				->setMethod($methodCode)
				->setMethodTitle($methodTitle)
				->setCost($cost)
				->setPrice($price);
	}
	
	/**
	 * Return the shipping method object
	 *
	 * @return array Mage_Shipping_Model_Rate_Result_Method
	 */
	protected function _getMethods(Mage_Shipping_Model_Rate_Request $request)
	{
		$methods = array();
		
		$dropShip = $this->_hasDropShips($request);
		
		$contactUsMethod = null;
		$contactUsMessage = '';
		$isLower = $this->_destAddrIsInLowerStates($request);

        $overWeightCharge = $this->getConfigData('max_weight_charge');
		
		// next day air (for all states)
		$methodCode = '1DA';
		$methodTitle = $this->_getMethodTitle($methodCode);
		if ($this->_exceedsWeightLimit()) {
			$methodTitle = $this->_getContactUsTitle($methodCode);
			$cost = $price = $overWeightCharge;
			$contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
			$contactUsMessage = $this->getConfigData('contact_us_message_weight');
		}
        elseif (!$dropShip) {
            if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
                $methods[] = $this->_getMethodError($methodCode, $methodTitle);
            }
            else {
                $price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
                if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
                $methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
            }
        }
        /*Below is old Original code */
            /*elseif ($dropShip) {
                $methodTitle = $this->_getContactUsTitle($methodCode);
                $cost = $price = '0.00';
                $contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                $contactUsMessage = $this->getConfigData('contact_us_message_dropship');
            } else {

                if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
                    $methods[] = $this->_getMethodError($methodCode, $methodTitle);
                }
                else {
                    $price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
                    if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
                    $methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                }
            }*/
		
		// second day air (for all states)
		$methodCode = '2DA';
		$methodTitle = $this->_getMethodTitle($methodCode);
		if ($this->_exceedsWeightLimit()) {
			$methodTitle = $this->_getContactUsTitle($methodCode);
			$cost = $price = $overWeightCharge;
			$contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
			$contactUsMessage = $this->getConfigData('contact_us_message_weight');
		}elseif (!$dropShip) {
            if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
                $methods[] = $this->_getMethodError($methodCode, $methodTitle);
            } else {
                $price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
                if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
                $methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
            }

        }
        /*Below is old Original code */

            /* elseif ($dropShip) {
                $methodTitle = $this->_getContactUsTitle($methodCode);
                $cost = $price = '0.00';
                $contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                $contactUsMessage = $this->getConfigData('contact_us_message_dropship');
            } else {
                if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
                    $methods[] = $this->_getMethodError($methodCode, $methodTitle);
                } else {
                    $price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
                    if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
                    $methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                }
            }*/
		
		// three day select (only for lower states)
		if ($isLower) {
			$methodCode = '3DS';
			$methodTitle = $this->_getMethodTitle($methodCode);
			if ($this->_exceedsWeightLimit()) {
				$methodTitle = $this->_getContactUsTitle($methodCode);
				$cost = $price = $overWeightCharge;
				$contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
				$contactUsMessage = $this->getConfigData('contact_us_message_weight');
			} elseif (!$dropShip) {
                if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
                    $methods[] = $this->_getMethodError($methodCode, $methodTitle);
                } else {
                    $price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
                    if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
                    $methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                }
            }
            /*Below is old Original code */
                /* elseif ($dropShip) {
                    $methodTitle = $this->_getContactUsTitle($methodCode);
                    $cost = $price = '0.00';
                    $contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                    $contactUsMessage = $this->getConfigData('contact_us_message_dropship');
                } else {
                    if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
                        $methods[] = $this->_getMethodError($methodCode, $methodTitle);
                    } else {
                        $price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
                        if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
                        $methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
                    }
                }*/
		}
		
		// ups ground (only for lower states)
		if ($isLower) {
			$methodCode = 'GND';
			$methodTitle = $this->_getMethodTitle($methodCode);
			if ($this->_exceedsWeightLimit()) {
				$methodTitle = $this->_getContactUsTitle($methodCode);
				$cost = $price = $overWeightCharge;
				$contactUsMethod = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
				$contactUsMessage = $this->getConfigData('contact_us_message_weight');
			} else {
				if (false === ($cost = $this->_getMethodRateTotalCost($request, $methodCode))) {
					$methods[] = $this->_getMethodError($methodCode, $methodTitle);
				}
				else {
					$price = $cost * $this->_getUpsRateFactor($methodCode) + $this->_getExtraCharges($request, $this->_getPerItemCharge($methodCode));
					if (($min = $this->_getMinShippingRate($methodCode)) && $price < $min) $price = $min;
					$methods[] = $this->_getMethod($methodCode, $methodTitle, $cost, $price);
				}
			}
		}
		
		if (isset($contactUsMethod)) {
			$contactUsMethod->setContactUs(true);
			$methods[] = $contactUsMethod;

            /*PATCH TO MAKE SURE WE ALWAYS HAVE LATEST CONTACT US MESSAGE - atheotsky*/
            if (Mage::registry('contact_us_message')) {
                Mage::unregister('contact_us_message');
            }

			Mage::register('contact_us_message', $contactUsMessage);
		}

		return $methods;
	}
	
	/**
	 * Return a config value for a shipping method, or the default
	 *
	 * @param string $base_key
	 * @param string $methodCode
	 * @return scalar
	 */
	protected function _getMethodConfig($base_key, $methodCode)
	{
		$key = $base_key . strtolower($methodCode);
		$value = $this->getConfigData($key);
		if (! isset($value)) $value = $this->getConfigData($base_key . 'default');
		return $value;
	}
	
	/**
	 * Get the per item charge depending on the method code from the configuration
	 *
	 * @param string $methodCode
	 * @return float
	 */
	protected function _getPerItemCharge($methodCode)
	{
		return floatval($this->_getMethodConfig('per_item_charge_', $methodCode));
	}
	
	/**
	 * Get the method title from the configuration
	 *
	 * @param string $methodCode
	 * @return string
	 */
	protected function _getMethodTitle($methodCode)
	{
		return $this->_getMethodConfig('title_', $methodCode);
	}
	
	/**
	 * Get the ups rate factor depending on the method code from the configuration
	 *
	 * @param string $methodCode
	 * @return float
	 */
	protected function _getUpsRateFactor($methodCode)
	{
		return floatval($this->_getMethodConfig('ups_rate_factor_', $methodCode));
	}
	
	/**
	 * Get the minimum shipping rate depending on the method code from the configuration
	 *
	 * @param string $methodCode
	 * @return float
	 */
	protected function _getMinShippingRate($methodCode)
	{
		return floatval($this->_getMethodConfig('min_shipping_rate_', $methodCode));
	}
	
	/**
	 * Get the method title if the contact us message was displayed
	 *
	 * @param string $methodCode
	 * @return string
	 */
	protected function _getContactUsTitle($methodCode)
	{
		return $this->_getMethodConfig('contact_us_title_', $methodCode);
	}
	
	/**
	 * Return the upper weight limit
	 *
	 * @param CreativeArc_Shipping_Model_Box $box
	 * @return float
	 */
	protected function _getUpperWeightLimit(CreativeArc_Shipping_Model_Box $box = null)
	{
		return floatval($this->getConfigData('max_box_weight'));
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
		$codes = array('1DA', '2DA', '3DS', 'GND');
        $methods = array();
        foreach ($codes as $code) $methods[$code] = $this->_getMethodTitle($code);
        return $methods;
	}
	
	/**
	 * Return all or part of an options array
	 *
	 * @param array $array
	 * @param string $key
	 * @param string $type
	 * @return array|string
	 */
	protected function _getOptionsArray($array, $key = null, $type = '')
	{
		if (! isset($key)) return $array;
		if (! isset($array[$key])) return false;
		if (! $type) return $array[$key];
		if (! isset($array[$key][$type])) return false;
		return $array[$key][$type];
	}
	
	/**
	 * Return pickup options
	 *
	 * @param string $key
	 * @param string $type
	 * @return array|string
	 */
	public function getPickupOptions($key = null, $type = '')
	{
		$pickup = array(
			'RDP'    => array("label" => 'Regular Daily Pickup', 'code' => '01'),
			'OCA'    => array("label" => 'On Call Air', 'code' => '07'),
			'OTP'    => array("label" => 'One Time Pickup', 'code' => '06'),
			'LC'     => array("label" => 'Letter Center', 'code' => '19'),
			'CC'     => array("label" => 'Customer Counter', 'code' => '03'),
			'SRR'    => array("label" => 'Suggested Retail Rates', 'code' => '11'),
			'ASC'    => array("label" => 'Air Service Center', 'code' => '20'),
		);
		return $this->_getOptionsArray($pickup, $key, $type);
	}
	
	/**
	 * Return container options
	 *
	 * @param string $key
	 * @param string $type
	 * @return array|string
	 */
	public function getContainerOptions($key = null, $type = '')
	{
		$container = array(
			'CP'    => array("label" => 'Customer Packaging', 'code' => '00'),
			'ULE'   => array("label" => 'UPS Letter Envelope', 'code' => '01'),
			'UT'    => array("label" => 'UPS Tube', 'code' => '03'),
			'UEB'   => array("label" => 'UPS Express Box', 'code' => '21'),
		);
		return $this->_getOptionsArray($container, $key, $type);
	}
	
	/**
	 * Return destination type options
	 *
	 * @param string $key
	 * @param string $type
	 * @return array|string
	 */
	public function getDestTypeOptions($key = null, $type = '')
	{
		$destType = array(
			'COM'   => array("label" => 'Commercial', 'code' => '02'),
			'RES'   => array("label" => 'Residential', 'code' => '01'),
		);
		return $this->_getOptionsArray($destType, $key, $type);
	}
	
	/**
	 * Return customer classification  options
	 *
	 * @param string $key
	 * @param string $type
	 * @return array|string
	 */
	public function getCustomerClassificationOptions($key = null, $type = '')
	{
		$classification = array(
			'W'   => array("label" => 'Wholesale', 'code' => '01'),
			'O'   => array("label" => 'Occasional', 'code' => '03'),
			'R'   => array("label" => 'Retail', 'code' => '04'),
		);
		return $this->_getOptionsArray($classification, $key, $type);
	}
	
	public function getMethodOptions($key = null, $type = '')
	{
		$codes = array(
			'1DA' => array('label' => 'UPS Next Day Air', 'code' => '01'),
			'2DA' => array('label' => 'UPS Second Day Air', 'code' => '02'),
			'GND' => array('label' => 'UPS Ground', 'code' => '03'),
			'3DS' => array('label' => 'UPS Three-Day Select', 'code' => '12'),
		);
		return $this->_getOptionsArray($codes, $key, $type);
	}
	
	protected function _mapUpsMethodCodeToValidMagentoMethod($code)
	{
		foreach (array_keys($this->getAllowedMethods()) as $key)
		{
			if ($this->getMethodOptions($key, 'code') === $code) return $key;
		}
		return '';
	}
}
