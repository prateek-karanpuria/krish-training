define([], function() {
    'use strict';

    return function(checkoutData) {
        const orig = checkoutData.getSelectedShippingAddress;

        checkoutData.getSelectedShippingAddress = function() {
            const address = orig.bind(checkoutData)();
            console.log('Selected shipping address', address);
            return address;
        }

        return checkoutData;
    }
});
