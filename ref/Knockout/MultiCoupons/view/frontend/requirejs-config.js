/*
 * Copyright © 2017 Rocket Bazaar. All rights reserved.
 * See COPYING.txt for license details
 */
var config = {
    paths: {
      'rb-multicoupons': 'RB_MultiCoupons/js/view/cart/rb-multicoupons',
      'rb-applied-coupons': 'RB_MultiCoupons/js/view/cart/applied-coupons'
    },
    shim: {
      'rb-multicoupons': {
          deps: ['jquery']
      },
      'rb-applied-coupons': {
          deps: ['jquery','rb-multicoupons']
      }
    },
    map: {
      '*': {
         'Magento_SalesRule/js/action/set-coupon-code': 'RB_MultiCoupons/js/view/cart/set-coupon-code',
         'IWD_Opc/js/action/set-coupon-code': 'RB_MultiCoupons/js/view/iwd/set-coupon-code'
      }
    }
};
