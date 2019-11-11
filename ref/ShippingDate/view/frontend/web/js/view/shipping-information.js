define(
    [
        'jquery',
        'ko',
        'Magento_Checkout/js/view/shipping-information'
    ],
    function(
        $,
        ko,
        Component
    ) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Ktpl_ShippingDate/shipping-information'
            },

            initialize: function () {
                var self = this;
                this._super();
            }

        });
    }
);