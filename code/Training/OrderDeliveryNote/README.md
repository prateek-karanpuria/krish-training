## Training Order Delivery Note Magento 2 module

The module was created for learning to add order delivery note & following features were accomplished:

i) On checkout page, add "Delivery Note" field in shipping section and it should be saved with order
data.

ii) Display this "Delivery Note" in order shipment mails and on order view page in admin panel

Ref: https://github.com/sohelrana09/magento2-module-delivery-date/tree/master/SR/DeliveryDate

## Prerequisites

* Magento 2.3
* PHP 7.2


## Installing

To install the module simply put all the files inside 

```
app/code/Training/OrderDeliveryDate/

```

And run the following commands in the root of your M2 installation

```
bin/magento module:enable Training_OrderDeliveryNote
bin/magento setup:upgrade

```


## Authors
  Prateek Karanpuria <prateek.karanpuria@krishtechnolabs.com>


## License
