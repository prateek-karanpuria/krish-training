<?php

/**
 * Custom import script to add data in EAV attribute [color & size]
 * 
 * Note:
 *  - Make 'Catalog Input Type for Store Owner' as 'Text Swatch' for EAV attribute [color & size]
 *  - Keep strings.php file & this file in Magento root before running it.
 */

/**
 * Data-set & arrays for EAV attributes
 */
require_once('strings.php');

require_once('app/bootstrap.php');

use Magento\Framework\App\Bootstrap;

error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Print result with formatted content
 */
function print2($context = '') {
    echo '<pre>';
    print_r($context);
    echo '</pre>';
}

$bootstrap = Bootstrap::create(BP, $_SERVER);
$objectManager = $bootstrap->getObjectManager();

$entityType = 'catalog_product';

/**
 * Get directory path
 */
// $directory = $objectManager->get('\Magento\Framework\Filesystem\DirectoryList');
// $path      =  $directory->getRoot();

$objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
$eavConfig     = $objectManager->get('\Magento\Eav\Model\Config');
$eavSetup      = $objectManager->get('\Magento\Eav\Setup\EavSetup');
$storeManager  = $objectManager->get('Magento\Store\Model\StoreManagerInterface');

/**
 * Get all stores info
 * Form store array
 */
$stores = $storeManager->getStores();

$storesArray = [];
if ($stores) {
    foreach ($stores as $store) {
       $storesArray[$store->getId()] = $store->getName();
    }
}
$allStores = array_merge(["All Store Views"], $storesArray);

if ($eav_attribute_names) {
    foreach ($eav_attribute_names as $attributeCode) {
        /**
         * Get attribute code id based on eav attribute name
         */
        $attribute = $eavConfig->getAttribute($entityType, $attributeCode);

        /**
         * Set dynamic EAV dataset in variable
         */
        $eavDataSet = ${$attributeCode};

        for ($i = 0; $i < count($eavDataSet); $i++) {
            $attributeCodeVal = $eavDataSet[$i];

            $option = [];

            $option['attribute_id'] = $attribute->getAttributeId();

            /**
             * Keep it blank for getting the last ID generated automatically by an IDENTITY/AUTOINCREMENT column.
             */
            $optionId = '';

            foreach (array_keys($allStores) as $storeId) {
                $option['value'][$optionId][$storeId] = $attributeCodeVal;
            }

            /**
             * Refer: Magento\Eav\Setup\EavSetup class -> addAttributeOption() function for more reference.
             */
            $eavSetup->addAttributeOption($option);
        }
    }
}
