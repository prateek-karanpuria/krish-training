/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    [
        'ko',
        'Magento_Checkout/js/model/quote',
        'Aheadworks_OneStepCheckout/js/model/estimation-data-resolver',
        'Aheadworks_OneStepCheckout/js/action/get-sections-details',
        'Magento_Checkout/js/model/shipping-service',
        'Aheadworks_OneStepCheckout/js/model/payment-methods-service',
        'Aheadworks_OneStepCheckout/js/model/totals-service',
        'Magento_Checkout/js/model/full-screen-loader'
    ],
    function (
        ko,
        quote,
        estimationDataResolver,
        getSectionsDetailsAction,
        shippingService,
        paymentMethodsService,
        totalsService,
        fullScreenLoader
    ) {
        'use strict';

        quote.shippingAddress.subscribe(function () {
            if (estimationDataResolver.resolveBillingAddress()
                && estimationDataResolver.resolveShippingAddress()
                && !quote.isQuoteVirtual()
            ) {
                //shippingService.isLoading(true);
                //paymentMethodsService.isLoading(true);
                //totalsService.isLoading(true);
                fullScreenLoader.startLoader();
                getSectionsDetailsAction(['shippingMethods', 'paymentMethods', 'totals']).always(function () {
                    //shippingService.isLoading(false);
                    //paymentMethodsService.isLoading(false);
                    //totalsService.isLoading(false);
                    fullScreenLoader.stopLoader();
                });
            }
        });

        return {};
    }
);
