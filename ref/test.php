<?php

// Keep this file inn project root and execute

ini_set('display_errors', 1);

echo 'in';

//echo \Magento\Framework\AppInterface::VERSION;

use Magento\Framework\App\Bootstrap;
require_once('app/bootstrap.php');

$bootstrap = Bootstrap::create(BP, $_SERVER);

$objectManager = $bootstrap->getObjectManager();
$result = $objectManager->get('\Ktpl\Skydailywebshipments\Cron\ExportDailyWebShipments')->getDataFromCreditMemo();

echo '<pre>';
print_r($result);
echo '</pre>';
