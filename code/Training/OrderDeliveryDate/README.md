## Training Order Delivery Date Magento 2 module

The module was created as an exercise to add order delivery date & following features were accomplished:

i) On checkout page, add "Delivery Date" field in shipping section and it should be saved with order
data.

ii) Display this "Delivery Date" in order shipment mails and on order view page in admin panel


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
bin/magento module:enable Training_OrderDeliveryDate
bin/magento setup:upgrade

```


## Authors
  Prateek Karanpuria <prateek.karanpuria@krishtechnolabs.com>


## License
