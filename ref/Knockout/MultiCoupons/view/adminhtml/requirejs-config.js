/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
 var config = {
    paths: {
    	'rb-multicoupons': 'RB_MultiCoupons/js/view/cart/rb-multicoupons'
    },
    shim: {
		'rb-multicoupons': {
			deps: ['jquery','Magento_Sales/order/create/form']
		}
	}
};
