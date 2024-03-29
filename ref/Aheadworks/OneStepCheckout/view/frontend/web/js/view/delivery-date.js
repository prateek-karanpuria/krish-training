/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define(
    [
        'jquery',
        'underscore',
        'ko',
        'Magento_Ui/js/form/form',
        'Magento_Checkout/js/model/quote',
        'Aheadworks_OneStepCheckout/js/model/checkout-data',
        'Aheadworks_OneStepCheckout/js/model/delivery-date/delivery-date',
        'uiRegistry',
        'moment',
        'mageUtils',
        'Magento_Checkout/js/model/shipping-save-processor/default',
        'Aheadworks_OneStepCheckout/js/action/get-sections-details',
        'Magento_Checkout/js/model/shipping-service',
        'Aheadworks_OneStepCheckout/js/model/payment-methods-service',
        'Aheadworks_OneStepCheckout/js/model/totals-service',
        'Magento_Checkout/js/model/full-screen-loader',
        'mage/url'
    ],
    function (
        $,
        _,
        ko,
        Component,
        quote,
        checkoutData,
        deliveryDate,
        registry,
        moment,
        utils,
        shippingSaveProcesser,
        getSectionsDetailsAction,
        shippingService,
        paymentMethodsService,
        totalsService,
        fullScreenLoader,
        url
    ) {
        'use strict';
        
        
        var deliveryDateConfig = window.checkoutConfig.deliveryDate;

        return Component.extend({
            defaults: {
                template: 'Aheadworks_OneStepCheckout/delivery-date',
                inputDateFormat: 'y-MM-dd',
                outputDateFormat: 'MM/dd/y',
                isShown: false
            },

            /**
             * @inheritdoc
             */
            initialize: function () {
                var formData = checkoutData.getDeliveryDateFormData(),
                    self = this;

                this._super();

                this.inputDateFormat = utils.normalizeDate(this.inputDateFormat);
                this.outputDateFormat = utils.normalizeDate(this.outputDateFormat);

                if (formData) {
                    this._copyFormDataToDeliveryDate(formData);
                }
                registry.async('checkoutProvider')(function (checkoutProvider) {
                    if (formData) {
                        if (formData.date !== undefined && formData.date != '') {
                            _.extend(
                                formData,
                                {'date': moment(formData.date, self.outputDateFormat).format(self.inputDateFormat)}
                            );
                        }
                        checkoutProvider.set(
                            'deliveryDate',
                            _.extend({}, checkoutProvider.get('deliveryDate'), formData)
                        );
                    }
                    checkoutProvider.on('deliveryDate', function (formData) {
                        self._copyFormDataToDeliveryDate(formData);
                        checkoutData.setDeliveryDateFormData(formData);
                    });
                    if (formData) {
                        checkoutProvider.trigger('deliveryDate.date.data.validateDate');
                    }
                });
            },

            /**
             * @inheritdoc
             */
            initObservable: function () {
                this._super();

                this.isShown = ko.computed(function () {
                    return !quote.isQuoteVirtual() && deliveryDateConfig.isEnabled;
                });

                return this;
            },

            /**
             * @inheritdoc
             */
            validate: function () {
                 if (this.isShown()) {
                    if (typeof (PickupAtStore) !== "undefined" && PickupAtStore.isPASSelected()) {
                    }
                    else
                    {
                        this.source.set('params.invalid', false);
                        this.source.trigger('deliveryDate.data.validate');
                    }
                }
            },

            /**
             * Copy form data to delivery date
             *
             * @param {Object} formData
             */
            _copyFormDataToDeliveryDate: function (formData) {
                deliveryDate.date(formData.date);
                if (formData.time !== undefined) {
                    deliveryDate.timeSlot(formData.time);
                }
            }
        });
    }
);
