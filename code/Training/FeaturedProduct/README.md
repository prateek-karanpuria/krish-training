# Training Featured Product Magento 2 module

The module was created as an exercise for accomplishing following points:

i) Add one custom product attribute i.e. "Featured Products" with Yes/No option i.e. using Boolean source model in default attribute set of native Magento.

ii) From admin panel set Yes for few products

iii) Display Feature Product link in top bar 

iv) Feature product link will display products which are set to "Yes" in feature products attribute.


### Prerequisites

* Magento 2.3
* PHP 7.2

### Installing

To install the module simply put all the files inside 

```
app/code/Training/FeaturedProduct/

```

And run the following commands in the root of your M2 installation

```
bin/magento module:enable Training_FeaturedProduct
bin/magento setup:upgrade

```
## Author
  Prateek Karanpuria <prateek.karanpuria@krishtechnolabs.com>


## License
