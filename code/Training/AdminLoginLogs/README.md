## Training Admin Login Logs Magento 2 module

The module was created as an exercise for accomplishing following points:

i) Track admin login activity along with below values:
    1) Username
    2) IP Address
    3) Status (login successful/or not)
    4) Date & Time

ii) Manage GRID in admin panel to review all the logs.


## Prerequisites

* Magento 2.3
* PHP 7.2


## Installing

To install the module simply put all the files inside 

```
app/code/Training/AdminLoginLogs/

```

And run the following commands in the root of your M2 installation

```
bin/magento module:enable Training_AdminLoginLogs
bin/magento setup:upgrade

```

## Author
  Prateek Karanpuria <prateek.karanpuria@krishtechnolabs.com>


## License
