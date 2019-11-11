/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Checkout/js/view/summary/abstract-total',
    'Magento_Checkout/js/model/quote'
], function (Component, quote) {
    'use strict';

    return Component.extend({
        /**
         * Get pure value.
         *
         * @return {*}
         */
        getPureValue: function () {
            var totals = quote.getTotals()();

            if (totals) {
                return totals.subtotal;
            }

            return quote.subtotal;
        },

        /**
         * @return {*|String}
         */
        getValue: function () {
            return this.getFormattedPrice(this.getPureValue());
        },
        
        /**
         * @return {*}
         */
        isShippingStep: function () {
            return this.isFullMode();
        }
    });
});
