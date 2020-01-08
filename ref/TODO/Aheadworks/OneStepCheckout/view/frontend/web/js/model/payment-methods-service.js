/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    [
        'ko',
        'uiRegistry',
        'Magento_Checkout/js/model/quote',
        'Aheadworks_OneStepCheckout/js/model/estimation-data-resolver',
        'Aheadworks_OneStepCheckout/js/model/same-as-shipping-flag',
        'Aheadworks_OneStepCheckout/js/action/get-sections-details',
        'Aheadworks_OneStepCheckout/js/model/totals-service',
        'Magento_Checkout/js/model/full-screen-loader'
    ],
    function (
        ko,
        registry,
        quote,
        estimationDataResolver,
        sameAsShippingFlag,
        getSectionsDetailsAction,
        totalsService,
        fullScreenLoader
    ) {
        'use strict';

        var isLoading = ko.observable(false);

        /**
         * Update payment methods
         */
        function updatePaymentMethods() {
            if (estimationDataResolver.resolveBillingAddress()
                && estimationDataResolver.resolveShippingAddress()
            ) {
                if (!isLoading()) {
                    isLoading(true);
                    //totalsService.isLoading(true);
                    fullScreenLoader.startLoader();
                    getSectionsDetailsAction(['paymentMethods', 'totals'], true).always(function () {
                        isLoading(false);
                        //totalsService.isLoading(false);
                        fullScreenLoader.stopLoader();
                    });
                }
            }
        }

        quote.billingAddress.subscribe(updatePaymentMethods);
        sameAsShippingFlag.sameAsShipping.subscribe(function () {
            if (!quote.isQuoteVirtual()) {
                updatePaymentMethods();
            }
        });

        return {
            isLoading: isLoading,

            /**
             * Bind address fields
             *
             * @param {string} path
             */
            bindAddressFields: function (path) {
                registry.async(path)(function (element) {
                    element.on('value', updatePaymentMethods);
                });
            }
        };
    }
);
