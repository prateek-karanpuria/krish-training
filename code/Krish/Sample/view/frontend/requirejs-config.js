/**
 * @author Vishves Shah <vishves.shah@krishtechnolabs.com>
 */

var config = {
  map: {
    '*': {
      'sampleWidget': 'Krish_Sample/js/sampleWidget',
    },
  },
  config: {
    mixins: {
      'Magento_Theme/js/view/breadcrumbs': {
        'Krish_Sample/js/view/breadcrumbs': true,
      },
      'Magento_Ui/js/lib/validation/validator': {
        'Krish_Sample/js/validator-mixin': true,
      },
      'Magento_Checkout/js/action/select-shipping-method' : {
        'Krish_Sample/js/action/select-shipping-method-wrapper': true
      },
    },
  },
  deps: [
    'Krish_Sample/js/everyPageRun',
  ],
};
