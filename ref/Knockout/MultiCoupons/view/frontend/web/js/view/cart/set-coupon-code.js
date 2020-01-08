/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
define(
    [
        'ko',
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/resource-url-manager',
        'Magento_Checkout/js/model/error-processor',
        'Magento_SalesRule/js/model/payment/discount-messages',
        'mage/storage',
        'mage/translate',
        'Magento_Checkout/js/action/get-payment-information',
        'Magento_Checkout/js/model/totals',
        'Magento_Checkout/js/model/full-screen-loader'
    ],
    function (
        ko, $, quote, urlManager, errorProcessor, messageContainer, storage, $t, getPaymentInformationAction, totals,
        fullScreenLoader
    ) {
        'use strict';

        return function (couponCode, isApplied) {
            var quoteId = quote.getQuoteId(),
                url = urlManager.getApplyCouponUrl(couponCode, quoteId),
                successMessage = $.mage.__('Your coupon was successfully applied.'),
                invalidMessage = $.mage.__('Your coupon is invalid.'),
                removedMessage = $.mage.__('Your coupon was successfully removed.');

            fullScreenLoader.startLoader();

            return storage.put(
                url,
                {},
                false
            ).done(
                function (response) {
                    if (response === true) {
                        var deferred = $.Deferred();

                        isApplied(true);
                        totals.isLoading(true);
                        getPaymentInformationAction(deferred);
                        $.when(deferred).done(function () {
                            fullScreenLoader.stopLoader();
                            totals.isLoading(false);
                        });
                        messageContainer.addSuccessMessage({
                            'message': successMessage
                        });
                    }else{
                        var deferred = $.Deferred();
                        var responseData = JSON.parse(response);
                        isApplied(true);
                        totals.isLoading(true);
                        getPaymentInformationAction(deferred);
                        $.when(deferred).done(function () {
                            fullScreenLoader.stopLoader();
                            totals.isLoading(false);
                        });
                        if(responseData['invalid'] != ''){
                            messageContainer.addErrorMessage({
                                'message': invalidMessage
                            });
                        }else{
                            if(responseData['removed'] != ''){
                                messageContainer.addSuccessMessage({
                                    'message': removedMessage
                                });
                            }else{
                                messageContainer.addSuccessMessage({
                                    'message': successMessage
                                });
                            }
                        }
                        $('#discount-code').val(responseData['applied']);
                    }
                }
            ).fail(
                function (response) {
                    fullScreenLoader.stopLoader();
                    totals.isLoading(false);
                    errorProcessor.process(response, messageContainer);
                }
            );
        };
    }
);
