/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define([
    'Aheadworks_OneStepCheckout/js/view/actions-toolbar/renderer/default'
], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Aheadworks_OneStepCheckout/actions-toolbar/renderer/paypal-express'
        },

        /**
         * Redirect to PayPal
         */
        continueToPayPal: function () {
            var self = this;

            this._beforeAction().done(function () {
                self._getMethodRenderComponent().continueToPayPal();
            });
        }
    });
});
