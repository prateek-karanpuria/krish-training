var config = {
    "map": {
        "*": {
            "OwlCarousel": "Training_Testimonial/js/owl-carousel",
            test_a: "Training_Testimonial/js/a"
        }
    },

    "shim": {
        "Training_Testimonial/js/owl.carousel.min": ["jquery"],
        deps: [
            // Loads our custom Training_Testimonial/js/checkout-data-mixin first then Krish sample one
            "Krish_Sample/js/action/select-shipping-method-wrapper"
        ]
    },

    config: {
        mixins: {
            'Magento_Checkout/js/checkout-data': {
                'Training_Testimonial/js/checkout-data-mixin': true
            }
        }
    },

    deps: ['Training_Testimonial/js/log-when-loaded'],

    paths: {
        'custom_js': 'Training_Testimonial/js'
    }
};
