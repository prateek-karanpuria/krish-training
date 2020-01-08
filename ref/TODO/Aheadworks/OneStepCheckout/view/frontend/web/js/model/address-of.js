/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    [
        'ko',
        'Aheadworks_OneStepCheckout/js/model/checkout-data'
    ],
    function (ko, oscCheckoutData) {
        'use strict';

        var addressOf = ko.observable(oscCheckoutData.getAddressOf());
        addressOf.subscribe(function (newValue) {
            oscCheckoutData.setAddressOf(newValue)
        });

        return {
            addressOf: addressOf
        };
    }
);
