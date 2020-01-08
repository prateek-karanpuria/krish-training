/**
* Copyright 2018 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

define([
    'ko',
    'jquery',
    'Magento_Ui/js/form/element/date',
    'moment',
    'underscore',
    'mage/translate'
], function (ko, $, Component, moment, _, $t) {
    'use strict';

    var dateRestrictionsConfig = window.checkoutConfig.deliveryDate.dateRestrictions,
        defaults = {
            dateFormat: 'mm\/dd\/yyyy',
            showsTime: false,
            timeFormat: null,
            showOn: 'both',
            buttonImage: null,
            buttonImageOnly: null,
            buttonText: $t('Select Date')
        };
    

    ko.bindingHandlers.awOscDatepicker = {
        /**
         * Initializes calendar widget on element and stores it's value to observable property.
         * Datepicker binding takes either observable property or object
         *  { storage: {ko.observable}, options: {Object} }.
         * For more info about options take a look at "mage/calendar" and jquery.ui.datepicker widget.
         * @param {HTMLElement} el - Element, that binding is applied to
         * @param {Function} valueAccessor - Function that returns value, passed to binding
         */
        init: function (el, valueAccessor) {
            var config = valueAccessor(),
                observable,
                options = {};

            _.extend(options, defaults);

            if (typeof config === 'object') {
                observable = config.storage;

                _.extend(options, config.options);
            } else {
                observable = config;
            }

            $(el).calendar(options);
            observable() && $(el).datepicker('setDate', observable());
            $(el).blur();

            ko.utils.registerEventHandler(el, 'change', function () {
                observable(this.value);
            });
            setTimeout(function()
            {
                $('.onestep-shipping-address .form .osc-fluid .fl-placeholder-state .control .select').find('option').each(function() {
                    if($(this).val() != "AE")
                    {
                        $(this).remove();
                    }else{
                        console.log($(this).val());
                    }
                    
                });
                $('.onestep-shipping-address .form .osc-fluid .fl-placeholder-state .control .select').trigger("change");
                
            }, 1000);
            jQuery(".totals-tax .amount").hide();
            function doStuff() 
            {
                if(jQuery('.totals-tax .mark').length)
                {
                    clearInterval(myTimer);
                    var taxval = jQuery(".totals-tax .mark").html();
                    var price = jQuery(".totals-tax .amount .price").html();
                    
                    jQuery(".totals-tax .mark").html('( '+ taxval +" = "+ price+ " ) ");
                }
            }
            var myTimer = setInterval(doStuff, 10);
            
        },

        /**
         * Update the control when the view model changes
         * @param {HTMLElement} el - Element, that binding is applied to
         * @param {Function} valueAccessor - Function that returns value, passed to binding
         */
        update: function(el, valueAccessor) {
            var config = valueAccessor(),
                observable;

            if (typeof config === 'object') {
                observable = config.storage;
            } else {
                observable = config;
            }

            observable() && $(el).datepicker('setDate', observable());
            $(el).blur();
        }
    };

    return Component.extend({
        defaults: {
            listens: {
                '${ $.provider }:${ $.dataScope }.data.validateDate': 'validateDate'
            }
        },
        minDateAvailable: '',

        onDeliveryElementRender: function (fileInput) {

            var quoteData = window.checkoutConfig.quoteData;
            var timeslotdate = quoteData['timeslotdate'];
            var currentDate = window.checkoutConfig.deliveryDate.currentCheckoutDate;
            if(timeslotdate != '')
            {
                //$("input.osc-datepicker").parent().find('.label').find('span').text('');
                $("input.osc-datepicker").val(timeslotdate);
                $("input.osc-datepicker").trigger("change");
            }
            else
            {
                //$("input.osc-datepicker").parent().find('.label').find('span').text('');
                $("input.osc-datepicker").val(currentDate);
                $("input.osc-datepicker").trigger("change");
            }
            //this.setTimeslot();
        },
        /**
         * @inheritdoc
         */
        // setTimeslot:function () {
        //     if($("[name='time'] option").length)
        //     {
        //         alert('hellllo');
        //         // $("[name='time'] option").each(function(){
        //         //     alert('hellllo');
        //         // });
        //         return;
        //     }
        //     else
        //     {
        //         console.log('else timeslote');
        //         //this.setTimeslot();
        //         //setTimeout(this.setTimeslot(),1000);
        //     }
        // },
        initConfig: function () {
            this._super();

            this.options.beforeShowDay = this.beforeShowDay.bind(this);

            return this;
        },

        /**
         * Before show date callback
         *
         * @param {date} date
         * @returns {Array}
         */
        beforeShowDay: function (date) {
            return [
                this._isAvailableDate(date),
                '',
                ''
            ];
        },

        /**
         * Validate date after loading checkout and set data from provider
         */
        validateDate: function () {
            if (this.source.get(this.dataScope) !== this.shiftedValue()) {
                var shiftedValue = this.shiftedValue();

                this.set('value', '');
                this.shiftedValue(shiftedValue);
            }
        },

        /**
         * @inheritdoc
         */
        onShiftedValueChange: function (shiftedValue) {
            if (!shiftedValue ||
                (
                    shiftedValue
                    && moment(shiftedValue, this.pickerDateTimeFormat, true).isValid()
                    && this._isAvailableDate(moment(shiftedValue, this.pickerDateTimeFormat, true).toDate())
                )
            ) {
                this._super(shiftedValue);
            } else {
                this.set('value', '');
                this.shiftedValue(this._getMinDateAvailable().format(this.pickerDateTimeFormat));
            }
        },

        /**
         * Retrieve minimal available date
         *
         * @returns {Date}
         */
        _getMinDateAvailable: function() {
            var currentDate = moment();

            if (!this.minDateAvailable) {
                while (!this.minDateAvailable) {
                    if (this._isAvailableDate(currentDate)) {
                        this.minDateAvailable = currentDate;
                        break;
                    }
                    currentDate = moment(currentDate).add(1, 'days');
                }
            }
            return this.minDateAvailable;
        },

        /**
         * Check if date is available
         *
         * @param {Date} date
         * @returns {boolean}
         */
        _isAvailableDate: function (date) {
            return this._isAvailableWeekday(date)
                && !this._isLessThanStartDeliveryDate(date)
                && !this._isInNonDeliveryPeriod(date);
        },

        /**
         * Check if date less than start delivery date
         *
         * @param {Date} date
         * @returns {boolean}
         */
        _isLessThanStartDeliveryDate: function (date) {
            //var quoteData = window.checkoutConfig.quoteData;

            var customdate = new Date(moment().add(0, 'days'));
            var customhours = customdate.getHours();
            if(customhours > 18)
            {
                var startDelivery = moment().add(1, 'days');  
            }
            else
            {
                var startDelivery = moment().add(dateRestrictionsConfig.minOrderDeliveryPeriod, 'days');    
            }
            return moment(date).isBefore(startDelivery, 'day');
        },

        /**
         * Check if weekday is available
         *
         * @param {Date} date
         * @returns {boolean}
         */
        _isAvailableWeekday: function (date) {
            var isAvailable = false,
                day = moment(date).day();

            if (!dateRestrictionsConfig.weekdays.length) {
                isAvailable = true;
            }
            _.each(dateRestrictionsConfig.weekdays,  function (weekday) {
                if (parseInt(weekday) == day) {
                    isAvailable = true;
                }
            });

            return isAvailable;
        },

        /**
         * Check if date in non delivery period
         *
         * @param {Date} date
         * @returns {boolean}
         */
        _isInNonDeliveryPeriod: function (date) {
            var result = false,
                checkDate = moment(date);

            _.each(dateRestrictionsConfig.nonDeliveryPeriods, function (period) {
                var periodType = period.period_type,
                    fromDate,
                    toDate;

                if (periodType == 'recurrent_day_of_week'
                    && checkDate.day() == period.period.weekday
                ) {
                    result = true;
                } else if (periodType == 'recurrent_day_of_month'
                    && checkDate.date() == period.period.day_of_month
                ) {
                    result = true;
                } else {
                    fromDate = moment(period.period.from_date, this.pickerDateTimeFormat, true);

                    if (periodType == 'single_day'
                        && checkDate.date() == fromDate.date()
                        && checkDate.month() == fromDate.month()
                        && checkDate.year() == fromDate.year()
                    ) {
                        result = true;
                    } else if (periodType == 'from_to') {
                        toDate = moment(period.period.to_date, this.pickerDateTimeFormat, true);

                        if ((checkDate.isSame(fromDate) || checkDate.isAfter(fromDate))
                            && (checkDate.isSame(toDate) || checkDate.isBefore(toDate))
                        ) {
                            result = true;
                        }
                    }
                }
            }, this);

            return result;
        }
    });
});
