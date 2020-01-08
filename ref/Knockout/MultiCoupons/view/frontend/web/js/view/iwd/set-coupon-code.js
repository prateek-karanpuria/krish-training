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
        'IWD_Opc/js/model/payment/discount-messages',
        'mage/storage',
        'mage/translate',
        'Magento_Checkout/js/action/get-payment-information',
        'Magento_Checkout/js/model/totals',
        'Magento_Checkout/js/model/full-screen-loader',
        'Magento_Checkout/js/model/payment/method-list',
        'Magento_Checkout/js/action/set-shipping-information',
        'Magento_Checkout/js/model/payment-service',
        'Magento_Checkout/js/action/get-totals'
    ],
    function (
        ko, $, quote, urlManager, errorProcessor, messageContainer, storage, $t, getPaymentInformationAction, totals,
        fullScreenLoader, paymentMethodList, setShippingInformationAction, paymentService, getTotalsAction
    ) {
        'use strict';

        return function (couponCode, isApplied, isLoading) {
            var quoteId = quote.getQuoteId(),
                url = urlManager.getApplyCouponUrl(couponCode, quoteId),
                successMessage = $.mage.__('Your coupon was successfully applied.'),
                invalidMessage = $.mage.__('Your coupon is invalid.'),
                removedMessage = $.mage.__('Your coupon was successfully removed.');
            return storage.put(
                url,
                {},
                false
            ).done(
                function (response) {
                    if (response) {
                        if(response === true){
                            var deferred = $.Deferred();
                            isLoading(false);
                            isApplied(true);
                            getTotalsAction([], deferred);
                            $.when(deferred).done(function() {
                                if(!quote.isVirtual() && quote.shippingMethod()){
                                    setShippingInformationAction();
                                }else{
                                    paymentService.setPaymentMethods(
                                        paymentMethodList()
                                    );
                                }
                            });
                            messageContainer.addSuccessMessage({'message': successMessage});
                        }else{
                            var responseData = JSON.parse(response);
                            var deferred = $.Deferred();
                            isApplied(true);
                            getTotalsAction([], deferred);
                            $.when(deferred).done(function () {
                                isLoading(false);
                                if(responseData['invalid'] != ''){
                                    messageContainer.addErrorMessage({
                                        'message': invalidMessage
                                    });
                                }else{
                                    if(responseData['removed'] != ''){
                                        if(!quote.isVirtual() && quote.shippingMethod()){
                                            setShippingInformationAction();
                                        }else{
                                            paymentService.setPaymentMethods(
                                                paymentMethodList()
                                            );
                                        }
                                        messageContainer.addSuccessMessage({
                                            'message': removedMessage
                                        });
                                    }else{
                                        if(!quote.isVirtual() && quote.shippingMethod()){
                                            setShippingInformationAction();
                                        }else{
                                            paymentService.setPaymentMethods(
                                                paymentMethodList()
                                            );
                                        }
                                        messageContainer.addSuccessMessage({
                                            'message': successMessage
                                        });
                                    }
                                }
                            });
                            $('#discount-code').val(responseData['applied']);
                        }
                    }
                }
            ).fail(
                function (response) {
                    totals.isLoading(false);
                    errorProcessor.process(response, messageContainer);
                }
            );
        };
    }
);
