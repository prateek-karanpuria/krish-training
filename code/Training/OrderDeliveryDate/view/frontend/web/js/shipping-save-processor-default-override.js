var payload = {

addressInformation: {
        shipping_address: quote.shippingAddress(),
        shipping_method_code: quote.shippingMethod().method_code,
        shipping_carrier_code: quote.shippingMethod().carrier_code,
        extension_attributes: {
            delivery_date: jQuery('[name="delivery_date"]').val();
        }
    }
};
