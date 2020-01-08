/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
define([
    'jquery'
], function (jQuery) {
    'use strict';
    window.rbMultiCoupons = new Class.create();
    rbMultiCoupons = {
        applyMultiCoupons: function(){
            var existingCoupons = document.getElementById('applied_coupons').value;
            var currentCouponCode = document.getElementById('coupons:code').value;
            var newCouponCodes = '';
            newCouponCodes = (existingCoupons != '') ? (existingCoupons + "," + currentCouponCode) : currentCouponCode;
            order.applyCoupon(newCouponCodes);
            order.loadArea(['totals', 'items', 'messages'], true);
        }
    }
});