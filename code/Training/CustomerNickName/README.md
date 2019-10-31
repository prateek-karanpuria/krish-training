## Training Customer Nick Name Magento 2 module

The module was created as an exercise for accomplishing following points:

i)  Add customer attribute named as "Nickname" via UpgradeSchema.

ii) Ask customer to add "Nickname" when creating new account from frontend.

iii) Display nickname value in backend customer account edit form, which can be editable.

iv) Show attribute value in customer account area in frontend, customer grid in backend.

v) Add system configuration in Customer Configuration tab for Show Nickname Yes/No, based on config value Nickname filed should be displayed or not in customer account create form and account dashboard in store front.


## Prerequisites

* Magento 2.3
* PHP 7.2


## Installing

To install the module simply put all the files inside 

```
app/code/Training/CustomerNickName/

```

And run the following commands in the root of your M2 installation

```
bin/magento module:enable Training_CustomerNickName
bin/magento setup:upgrade

```

## Author
  Prateek Karanpuria <prateek.karanpuria@krishtechnolabs.com>


## License
