/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    [
        'uiComponent',
        'Aheadworks_OneStepCheckout/js/model/checkout-data'
    ],
    function (Component, checkoutData, orderNote) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Aheadworks_OneStepCheckout/checkout-toggle',
                inputValue: ''
            }
        });
    }
);
