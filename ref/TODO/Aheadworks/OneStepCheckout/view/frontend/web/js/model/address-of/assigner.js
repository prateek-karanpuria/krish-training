/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define([
    'Aheadworks_OneStepCheckout/js/model/address-of/address-of',
    'Magento_Checkout/js/model/quote'
], function (addressOf, quote) {
    'use strict';

    var addressOfConfig = window.checkoutConfig.addressOf;

    return function (paymentData) {
        if (addressOfConfig.isEnabled && !quote.isQuoteVirtual()) {
            if (paymentData['extension_attributes'] === undefined) {
                paymentData['extension_attributes'] = {};
            }
            paymentData['extension_attributes']['address_of'] = addressOf.address_of();
        }
    };
});
