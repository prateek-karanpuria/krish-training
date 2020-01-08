/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Magento_Checkout/js/model/quote',
        'Magento_SalesRule/js/action/set-coupon-code',
        'Magento_SalesRule/js/action/cancel-coupon',
        'mage/translate',
        'Magento_Ui/js/modal/alert'
    ],
    function ($, ko, Component, quote, setCouponCodeAction, cancelCouponAction, $t, alert) {
        'use strict';

        var totals = quote.getTotals(),
            couponCode = ko.observable(null),
            isApplied = ko.observable(couponCode() != null);

        if (totals()) {
            couponCode(totals()['coupon_code']);
        }

        return Component.extend({
            defaults: {
                template: 'RB_MultiCoupons/view/cart/discount',
                appliedCouponSectionHeader: $.mage.__('Applied Coupons')
            },
            couponCode: couponCode,
            totals: quote.getTotals(),
            isVisible: ko.observable(quote.getTotals()['coupon_code']),
            /**
             * Applied flag
             */
            isApplied: isApplied,

            /**
             * Coupon code application procedure
             */
            apply: function() {
                var currentCouponCode = $('#discount-code-mask').val();
                var appliedCoupons = $('#discount-code').val();
                var alreadyCouponAppliedText = $.mage.__('Coupon Already Applied');
                if (this.validate()) {
                    if(appliedCoupons != '' && $.inArray(currentCouponCode,appliedCoupons.split(',')) != -1){
                        alert({
                            content: $.mage.__(alreadyCouponAppliedText)
                        });
                    }else{
                        var couponCodes = (appliedCoupons != '') ? appliedCoupons +","+currentCouponCode : currentCouponCode;
                        couponCode(couponCodes);
                        setCouponCodeAction(couponCode(), isApplied);
                    }
                    $('#discount-code-mask').val('');
                }
            },

            /**
             * Cancel using coupon
             */
            cancel: function() {
                if (this.validate()) {
                    couponCode('');
                    cancelCouponAction(isApplied);
                }
            },

            /**
             * Coupon form validation
             *
             * @returns {Boolean}
             */
            validate: function () {
                var form = '#discount-form';
                return $(form).validation() && $(form).validation('isValid');
            },
            removeCouponCode: function(couponCodeToRemove){
                var couponTextBox = $('#discount-code');
                var appliedCouponsData = couponTextBox.val().split(',');
                appliedCouponsData.splice($.inArray(couponCodeToRemove, appliedCouponsData),1);
                couponCode(appliedCouponsData.join(','));
                if(couponCode() != ''){
                    setCouponCodeAction(couponCode(), isApplied);
                }else{
                    couponCode('');
                    cancelCouponAction(isApplied);
                }
            },
            appliedCoupons: function(){
                return (this.totals()['coupon_code']) ? this.totals()['coupon_code'].split(',') : [];
            }
        });
    }
);
