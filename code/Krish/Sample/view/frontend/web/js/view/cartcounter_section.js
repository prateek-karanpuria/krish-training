/**
 * @author Vishves Shah <vishves.shah@krishtechnolabs.com>
 */

define([
  'uiComponent',
  'Magento_Customer/js/customer-data',
  'mage/translate',
], function(
    Component,
    customerData,
    $t) {
  'use strict';

  return Component.extend({
    initialize: function() {
      this._super();
      this.cartcounter = customerData.get('cartcounter');
    },
  });
});