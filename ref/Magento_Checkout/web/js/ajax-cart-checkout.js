define([
    'jquery',
    'Magento_Checkout/js/action/get-totals',
    'Magento_Customer/js/customer-data',
    'uiComponent',
    'mage/translate',
    'mage/calendar'
], function ($, getTotalsAction, customerData, Component, $t) {
    'use strict';


    return Component.extend({

        initialize: function () {
            this._super();
            this.qtyChangeEvent();
        },

        changeQty: function (data, event) {
            var currentElement = event.target;
            var Itemid = $(currentElement).attr('id');
            var ctrl = ($(currentElement).attr('id').replace('-upt', '')).replace('-dec', '');
            var currentQtyBox = $("#cart-" + ctrl + "-qty");
            var currentQty = $(currentQtyBox).val();
            if ($(currentElement).hasClass('increaseQty-' + Itemid)) {
                var newAdd = parseInt(currentQty) + parseInt(1);
                $(currentQtyBox).val(newAdd);
            } else if ($(currentElement).hasClass('decreaseQty-' + Itemid)) {
                if (currentQty > 0) {
                    var newAdd = parseInt(currentQty) - parseInt(1);
                    $(currentQtyBox).val(newAdd);
                }
            }
            alert("change");
            // this.qtyChangeEvent();
        },
        qtyChangeEvent: function () {
            $(document).ready(function () {
                $(document).on('click', "[name = 'update_cart_action']", function () {
                    var $this = $(this);
                    var Itemid = $this.attr('id');

                    var ctrl = ($(this).attr('id').replace('-upt', '')).replace('-dec', '');
                    var currentQty = $("#cart-" + ctrl + "-qty").val();
                    if ($this.hasClass('increaseQty-' + Itemid)) {
                        var newAdd = parseInt(currentQty) + parseInt(1);
                        $("#cart-" + ctrl + "-qty").val(newAdd);
                    } else if ($this.hasClass('decreaseQty-' + Itemid)) {
                        if (currentQty > 0) {
                            var newAdd = parseInt(currentQty) - parseInt(1);
                            $("#cart-" + ctrl + "-qty").val(newAdd);
                        }
                    }
                    $("#cart-" + ctrl + "-qty").trigger('change');
                });
                $(document).on('change', 'input[name$="[qty]"]', function () {
                    var form = $('form#form-validate');
                    $.ajax({
                        url: form.attr('action'),
                        data: form.serialize(),
                        showLoader: true,
                        success: function (res) {
                            var parsedResponse = $.parseHTML(res);
                            var result = $(parsedResponse).find("#form-validate");
                            var sections = ['cart'];
                            $("#form-validate").replaceWith(result);
                            // The mini cart reloading
                            customerData.reload(sections, true);
                            // The totals summary block reloading
                            var deferred = $.Deferred();
                            getTotalsAction([], deferred);
                            var isCartEmpty = $(res).find('#isCartEmpty').val();
                            console.log(isCartEmpty);
                            if(isCartEmpty == "true"){
                                location.reload();
                            }

                            $("#shopping-cart-table").find( ".cart.item" ).each(function( index ) {
                                var self = this;
                                $(this).find('select').change(function () {
                                    $(self).find(".save_subscription").show();
                                });
                                $(this).find('.input-date-picker').change(function () {
                                    $(self).find(".save_subscription").show();
                                });
                            });

                            $('.input-date-picker').each(function () {
                                var min_date = $(this).attr('data-min-date');
                                var selected_date = $(this).attr('data-date');
                                $(this).calendar({
                                    showsTime: false,
                                    changeMonth: false,
                                    changeYear: false,
                                    showOn: 'focus',
                                    hideIfNoPrevNext: true,
                                    showAnim: "",
                                    buttonImageOnly: null,
                                    buttonImage: null,
                                    showButtonPanel: false,
                                    showOtherMonths: false,
                                    showWeek: false,
                                    timeFormat: '',
                                    showTime: false,
                                    showHour: false,
                                    showMinute: false,
                                    buttonText: $t('Select Date'),
                                    dateFormat: "yy-mm-dd",
                                    minDate: new Date(min_date)
                                });

                                $(this).calendar().datepicker("setDate", new Date(selected_date));
                            });
                        },
                        error: function (xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            console.log(err.Message);
                        }
                    });
                });
            });
        }
    });
});