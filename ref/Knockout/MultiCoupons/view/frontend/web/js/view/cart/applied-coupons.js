/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */

define([
    'jquery',
    'ko',
    'underscore',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'mage/translate'
], function ($, ko, _, Component, quote, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'RB_MultiCoupons/view/cart/applied-coupons',
            appliedCouponSectionHeader: $.mage.__('Applied Coupons')
        },
        totals: quote.getTotals(),
        isVisible: ko.observable(quote.getTotals()['coupon_code']),
        
        removeCouponCode: function(couponCode){
            var couponTextBox = $('#coupon_code');
            var form = $('#discount-coupon-form');
            var removeCouponIndicator = $('#remove-rbcoupon');
            var appliedCouponsData = couponTextBox.val().split(',');
            removeCouponIndicator.val(1);
            appliedCouponsData.splice($.inArray(couponCode, appliedCouponsData),1);
            couponTextBox.val(appliedCouponsData.join(','));
            form.submit();
            removeCouponIndicator.val(0);
        },
        appliedCoupons: function(){
            return (this.totals()['coupon_code']) ? this.totals()['coupon_code'].split(',') : [];
        }
    });
});
