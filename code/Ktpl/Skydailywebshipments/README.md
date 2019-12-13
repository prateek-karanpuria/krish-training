## Ktpl Skydailywebshipments Magento 2 module

Skydailywebshipments extension is a custom extension which will generate daily shipment information CSV & place it in project root via cron scheduled. 

This extension will set daily cron for Shopsky store that will execute once in a day. Before installing this extension, you’ll need to have 'swatch_color' & 'swatch_size' EAV attribute in setup with your product items.

## Prerequisites

* Magento 2.3
* PHP 7.x


## Installing

To install the module simply put all the files inside 

```
app/code/Ktpl/Skydailywebshipments/

```

And run the following commands in the project root of your M2 installation

```
php bin/magento module:enable Ktpl_Skydailywebshipments
php bin/magento setup:upgrade

```

## Authors
  KTPL


## License
