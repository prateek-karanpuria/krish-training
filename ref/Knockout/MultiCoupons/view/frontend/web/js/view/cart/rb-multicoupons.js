/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
define([
    'jquery',
    'mage/translate',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/action/get-totals',
    'Magento_Ui/js/modal/alert'
], function ($, $t, quote, getTotalsAction, alert) {
    
    $.widget('rb.coupons',{
        options:{
            processStart: null,
            processStop: null,
            bindSubmit: true,
            messagesSelector: '[data-placeholder="messages"]',
            applyCouponButtonSelector: '.apply.action',
            applyCouponButtonDisabledClass: 'disabled',
            applyCouponTextWhileApplying: $.mage.__('Applying...'),
            applyCouponButtonTextDefault: $.mage.__('Apply Discount'),
            applyCouponButtonTextApplied: $.mage.__('Applied'),
            invalidCouponText: $.mage.__('Coupon Invalid'),
            alreadyCouponAppliedText: $.mage.__('Coupon Already Applied')
        },
        _create: function(){
            this.couponTextBoxMask = $('#coupon_code_mask');
            this.couponTextBox = $('#coupon_code');
            this.removeCouponIndicator = $('#remove-rbcoupon');
            if (this.options.bindSubmit) {
                this._bindSubmit();
            }
            $(this.options.applyCouponButtonSelector).on('click', $.proxy(function () {
                this.couponTextBoxMask.attr('data-validate', '{required:true}');
                $(this.element).validation().submit();
            }, this));
            
        },
        _bindSubmit: function () {
            var self = this;
            this.element.on('submit', function (e) {
                e.preventDefault();
                var currentCouponCode = self.couponTextBoxMask.val();
                if(self.couponTextBoxMask.val()){
                    self.options.applyCouponTextWhileApplying = $.mage.__("Applying...");
                    self.options.applyCouponButtonTextApplied = $.mage.__("Applied")
                    var appliedCoupons = self.couponTextBox.val();
                    if(appliedCoupons != '' && $.inArray(currentCouponCode,appliedCoupons.split(',')) != -1){
                        alert({
                            content: $.mage.__(self.options.alreadyCouponAppliedText)
                        });
                    }else{
                        var couponCodes = (self.couponTextBox.val() != '') ? self.couponTextBox.val()+","+self.couponTextBoxMask.val() : self.couponTextBoxMask.val();
                        self.couponTextBox.val(couponCodes);
                        self.submitForm($(this));
                    }
                }else if(self.removeCouponIndicator.val() == 1){
                    self.couponTextBoxMask.attr(self.options.applyCouponButtonDisabledClass, true);
                    self.options.applyCouponTextWhileApplying = $.mage.__("Removing...");
                    self.options.applyCouponButtonTextApplied = $.mage.__("Removed");
                    self.submitForm($(this));
                }
            });
        },
        submitForm: function (form) {
            var self = this;
            self.disableApplyCouponButton(form);
            $.ajax({
                url: form.attr('action'),
                data: form.serialize(),
                type: 'post',
                dataType: 'json',

                beforeSend: function () {
                    if (self.isLoaderEnabled()) {
                        $('body').trigger(self.options.processStart);
                    }
                },

                success: function (res) {
                    if (self.isLoaderEnabled()) {
                        $('body').trigger(self.options.processStop);
                    }
                    if (res.messages) {
                        $(self.options.messagesSelector).html(res.messages);
                    }
                    var successText = (self.options.applyCouponButtonTextApplied) ? $t(self.options.applyCouponButtonTextApplied) : $.mage.__("Applied");
                    self.options.applyCouponButtonTextApplied = (res.invalid) ? $t(self.options.invalidCouponText) : $t(successText);
                    self.couponTextBoxMask.val("");
                    self.couponTextBox.val(res.applied_coupons);
                    
                    var deferred = $.Deferred();
                    getTotalsAction([], deferred);
                    
                    self.enableApplyCouponButton(form);
                }
            });
        },
        disableApplyCouponButton: function (form) {
            var applyCouponTextWhileApplying = $t(this.options.applyCouponTextWhileApplying) || $.mage.__('Applying...'),
                applyCouponButton = $(form).find(this.options.applyCouponButtonSelector);
                
            applyCouponButton.addClass(this.options.applyCouponButtonDisabledClass);
            applyCouponButton.find('span').text($t(applyCouponTextWhileApplying));
            applyCouponButton.attr('title', $t(applyCouponTextWhileApplying));
        },
        
        enableApplyCouponButton: function (form) {
            var applyCouponButtonTextApplied = $t(this.options.applyCouponButtonTextApplied) || $.mage.__('Applied'),
                self = this,
                applyCouponButton = $(form).find(this.options.applyCouponButtonSelector);

            applyCouponButton.find('span').text($t(applyCouponButtonTextApplied));
            applyCouponButton.attr('title', $t(applyCouponButtonTextApplied));

            setTimeout(function () {
                var applyCouponButtonTextDefault = $t(self.options.applyCouponButtonTextDefault) || $.mage.__('Apply Discount');

                applyCouponButton.removeClass(self.options.applyCouponButtonDisabledClass);
                applyCouponButton.find('span').text($t(applyCouponButtonTextDefault));
                applyCouponButton.attr('title', $t(applyCouponButtonTextDefault));
                self.couponTextBoxMask.attr(self.options.applyCouponButtonDisabledClass, false);
            }, 1000);
        },
        
        isLoaderEnabled: function () {
            return this.options.processStart && this.options.processStop;
        }
    });
    return $.rb.coupons;
});