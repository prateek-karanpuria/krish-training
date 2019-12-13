## Ktpl Signature Magento 2 module

Signature extension is a custom extension which will add customer signature/no-signature text configured from backend whenever order gets placed/saved/invoiced/shipment generated. 

This extension will display signature text on storefront checkout page only when 'Terms & Conditions' option is enabled from Store > Configuration > Sales > Checkout.

## Prerequisites

* Magento 2.3
* PHP 7.x


## Installing

To install the module simply put all the files inside 

```
app/code/Ktpl/Signature/

```

And run the following commands in the project root of your M2 installation

```
php bin/magento module:enable Ktpl_Signature
php bin/magento setup:upgrade

```

## Authors
  KTPL


## License
