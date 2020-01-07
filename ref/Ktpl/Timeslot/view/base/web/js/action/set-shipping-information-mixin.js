require(['jquery', 'Magento_Checkout/js/model/quote', 'mage/url', 'Magento_Checkout/js/model/shipping-save-processor/default', 'Aheadworks_OneStepCheckout/js/action/get-sections-details', 'Magento_Checkout/js/model/shipping-service', 'Aheadworks_OneStepCheckout/js/model/payment-methods-service', 'Aheadworks_OneStepCheckout/js/model/totals-service', 'Magento_Checkout/js/model/full-screen-loader', 'Magento_Checkout/js/model/shipping-rate-registry', 'Magento_Checkout/js/model/shipping-rate-processor/customer-address', 'Magento_Checkout/js/model/shipping-rate-processor/new-address'], function($, quote, url, shippingSaveProcesser, getSectionsDetailsAction, shippingService, paymentMethodsService, totalsService, fullScreenLoader, rateRegistry, customerAddressProcessor, newAddressProcessor) {
    var multiselectedaddress = {};
    jQuery(document).ready(function($) {
        setTimeout(function(){ 
            if(jQuery(".shipping-method-title input[class='radio']:checked").val() == "freeshipping_freeshipping"){
                jQuery("#s_method_freeshipping_freeshipping").trigger('click');
            }
        }, 2000);
        // function doStuff() {
        //     if (jQuery('.onestep-shipping-method').length) {
        //         clearInterval(myTimer);
        //         jQuery(".onestep-shipping-method").hide();
        //         jQuery(".aw-onestep.aw-onestep-main .aw-mobile-hide").insertBefore(jQuery(".checkout-container"));
        //         shippingTimeSlot();
        //     }
        // }
        // var myTimer = setInterval(doStuff, 100);

        // function doStuff1() {
        //     if (jQuery('.shipping-address-items').length) {
        //         clearInterval(myTimer1);
        //         var address = quote.shippingAddress();
        //         multiselectedaddress['countryId'] = address.countryId;
        //         multiselectedaddress['region'] = address.region;
        //         multiselectedaddress['regionId'] = address.regionId;
        //         defaultSelectedAddress();
        //     }
        // }
        // var myTimer1 = setInterval(doStuff1, 100);
        // jQuery("[name='time']").find('option').each(function() {
        //     if (jQuery(this).val() != "") {
        //         jQuery(this).remove();
        //     }
        // });
    });
    jQuery(document).on('change', ".onestep-shipping-address [name='country_id']", function() {
        shippingTimeSlot();
    });
    jQuery(document).on('keypress', ".onestep-shipping-address [name='region']", function() {
        shippingTimeSlot();
    });
    jQuery(document).on('change', ".onestep-shipping-address [name='region_id']", function() {
        shippingTimeSlot();
    });
    jQuery(document).on('change', "[name='date']", function() {
        shippingTimeSlot();
    });
    jQuery(document).on('click', "a.ui-state-default", function() {
        shippingTimeSlot();
    });
    jQuery(document).on('change', "[name='date']", function() {
        shippingTimeSlot();
    });
    jQuery(document).on('click', 'input.osc-datepicker', function() {
        dateHasShippingSlot();
    });
    jQuery(document).on('click', ".action.action-select-shipping-item", function() {
        jQuery("[name='date']").val("");
        jQuery("[name='time']").find('option').each(function() {
            if (jQuery(this).val() != "") {
                jQuery(this).remove();
            }else {
                jQuery(this).text("Select Delivery Time");
            }
        });
        jQuery("[name='deliveryDate.time']").val("");
        jQuery("[name='deliveryDate.time']").hide();
        var address = quote.shippingAddress();
        multiselectedaddress['countryId'] = address.countryId;
        multiselectedaddress['region'] = address.region;
        multiselectedaddress['regionId'] = address.regionId;
        defaultSelectedAddress();
    });
    jQuery(document).on('click', "#checkout-step-pas #pas-yes", function() {
        var address = quote.shippingAddress();
        address.countryId = multiselectedaddress['countryId'];
        address.region = multiselectedaddress['region'];
        address.regionId = multiselectedaddress['regionId'];
        defaultSelectedAddress();
    });
    jQuery(document).on('change', "[name='time']", function() {
        region = jQuery(".onestep-shipping-address [name='region_id']").val();
        type = "select";
        if (region != "" && region != "undefined" && jQuery(".onestep-shipping-address [name='country_id']").val() != "" && jQuery("[name='country_id']").val() != "undefined" && jQuery("[name='date']").val() != "" && jQuery("[name='date']").val() != "undefined") {
            setShippingprice();
        }
    });

    function defaultSelectedAddress() {
        var address = quote.shippingAddress();
        jQuery(".onestep-shipping-address [name='country_id'] option[value='" + address.countryId + "']").prop('selected', true);
        jQuery(".onestep-shipping-address [name='region']").html(address.region);
        jQuery(".onestep-shipping-address [name='region_id'] option[value='" + address.regionId + "']").prop('selected', true);
        jQuery("[name='date']").change();
    }

    function setShippingprice() {
        
        var id = jQuery("[name='time'] option:selected").attr('data-title');
        var time = jQuery("[name='time'] option:selected").text();
        var datepicker = jQuery("input.osc-datepicker").val();
        if (jQuery("[name='deliveryDate.time']").css("display") != "block") {
            id = "";
            time = "";
        } 
        if (id !== "" && typeof id !== "undefined") {
            fullScreenLoader.startLoader();
            jQuery.ajax({
                type: "POST",
                url: url.build('timeslot/index/shippingprice'),
                data: {
                    id: id,
                    time: time,
                    datepicker: datepicker
                },
                success: function(data) {
                    getSectionsDetailsAction(['shippingMethods', 'paymentMethods', 'totals']).always(function() {
                        fullScreenLoader.stopLoader();
                    });
                    setTimeout(function(){ 
                        if(jQuery(".shipping-method-title input[class='radio']:checked").val() == "freeshipping_freeshipping"){
                            jQuery("#s_method_freeshipping_freeshipping").trigger('click');
                        } else{
                            jQuery(".shipping-method-title input:radio:first-child").trigger('click');    
                        }
                        
                    }, 2000);
                }
            });
        } 
        // else {
        //     id = "";
        //     time = "";
        //     jQuery.ajax({
        //         type: "POST",
        //         url: url.build('timeslot/index/shippingprice'),
        //         data: {
        //             id: id,
        //             time: time
        //         },
        //         success: function(data) {
        //             getSectionsDetailsAction(['shippingMethods', 'paymentMethods', 'totals']).always(function() {
        //                 fullScreenLoader.stopLoader();
        //             });
        //             setTimeout(function(){ 
        //                 console.log(jQuery(".shipping-method-title input[class='radio']:checked").val());
        //                 if(jQuery(".shipping-method-title input[class='radio']:checked").val() == "freeshipping_freeshipping"){
        //                     jQuery("#s_method_freeshipping_freeshipping").trigger('click');
        //                 }
        //             }, 2000);
        //         }
        //     });
        // }
    }

    function dateHasShippingSlot1() {
        var region;
        var type;
        region = jQuery(".onestep-shipping-address [name='region_id']").val();
        type = "select";
        if (region != "" && region != "undefined" && jQuery(".onestep-shipping-address [name='country_id']").val() != "" && jQuery(".onestep-shipping-address [name='country_id']").val() != "undefined" && jQuery("[name='date']").val() == "") {
            var country_id = jQuery(".onestep-shipping-address [name='country_id']").val();
            var date = new Date();
            var val = (date.getMonth() + 1) + "/" + date.getDate() + "/" + date.getFullYear();
            date = val;
            fullScreenLoader.startLoader();
            jQuery.ajax({
                type: "POST",
                url: url.build('timeslot/index/index'),
                data: {
                    country_id: country_id,
                    region_id: region,
                    type: type,
                    date: date
                },
                success: function(data) {
                    jQuery("[name='time']").find('option').each(function() {
                        if (jQuery(this).val() != "") {
                            jQuery(this).remove();
                        }else {
                            jQuery(this).text("Select Delivery Time");
                        }
                    });
                    jQuery("[name='deliveryDate.time']").val("");
                    jQuery("[name='deliveryDate.time']").hide();
                    jQuery("[name='date']").val("");
                    if (data == "tmp") {
                        jQuery(".ui-datepicker .ui-datepicker-calendar .ui-datepicker-today a").addClass("custom-datepicker-today-disable-a");
                    } else {
                        jQuery(".ui-datepicker .ui-datepicker-calendar .ui-datepicker-today a").removeClass("custom-datepicker-today-disable-a");
                    }
                }
            });
            fullScreenLoader.stopLoader();
        }
    }

    function shippingTimeSlot() {
        var region;
        var type;
        region = jQuery(".onestep-shipping-address [name='region_id']").val();
        type = "select";
        if (region != "" && region != "undefined" && jQuery(".onestep-shipping-address [name='country_id']").val() != "" && jQuery(".onestep-shipping-address [name='country_id']").val() != "undefined" && jQuery("[name='date']").val() != "" && jQuery("[name='date']").val() != "undefined") {
            var country_id = jQuery(".onestep-shipping-address [name='country_id']").val();
            var date = jQuery("[name='date']").val();
            fullScreenLoader.startLoader();
            jQuery.ajax({
                type: "POST",
                url: url.build('timeslot/index/index'),
                data: {
                    country_id: country_id,
                    region_id: region,
                    type: type,
                    date: date
                },
                success: function(data) {
                    if (data != "") {
                        if (data == "tmp") {} else {
                            var data = data.split('|');
                            jQuery('.datetime-alert').remove();
                            jQuery("[name='time']").find('option').each(function() {
                                if (jQuery(this).val() != "") {
                                    jQuery(this).remove();
                                } else {
                                    jQuery(this).text("Select Delivery Time");
                                }
                            });
                            if (data.length > 0) {
                                for (var i = 0; i < data.length; i++) {
                                    data1 = data[i].toString();
                                    data2 = data1.split('=');
                                    data3 = data2[0].split('+');
                                    jQuery("[name='time']").append('<option data-title="' + data3[1] + '" value="' + data3[0] + '">' + data2[1] + '</option>');
                                }
                            }
                            jQuery("[name='deliveryDate.time']").show();
                            jQuery("[name='time'] option:first").attr('selected','selected');
                            jQuery("[name='time']").trigger('change');
                        }
                    } else {
                        jQuery("[name='time']").find('option').each(function() {
                            if (jQuery(this).val() != "") {
                                jQuery(this).remove();
                            }else {
                                jQuery(this).text("Select Delivery Time");
                            }
                        });
                        jQuery("[name='deliveryDate.time']").val("");
                        jQuery("[name='deliveryDate.time']").hide();
                    }
                    fullScreenLoader.stopLoader();
                }
            });
        } else {
            jQuery("[name='date']").val("");
            jQuery("[name='time']").find('option').each(function() {
                if (jQuery(this).val() != "") {
                    jQuery(this).remove();
                }else {
                    jQuery(this).text("Select Delivery Time");
                }
            });
            jQuery("[name='deliveryDate.time']").val("");
            jQuery("[name='deliveryDate.time']").hide();
        }
    }
});