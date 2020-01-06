/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    [
        'uiComponent'
    ],
    function (Component) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Aheadworks_OneStepCheckout/payment-method'
            },

            /**
             * Get form key
             *
             * @returns {string}
             */
            getFormKey: function () {
                return window.checkoutConfig.formKey;
            }
        });
    }
);
