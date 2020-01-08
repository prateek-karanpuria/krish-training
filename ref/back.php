<?php
    public function translate($str) {
        $returnasit = $str;

        if (mb_detect_encoding($str) !== 'UTF-8') {
            $str = mb_convert_encoding($str,mb_detect_encoding($str),'UTF-8');
        }

        preg_match_all('/.|\n/u', $str, $matches);

        $chars = $matches[0];
        $arabic_count = 0;
        $latin_count = 0;
        $total_count = 0;

        foreach ($chars as $char) {
            $pos = $this->uniord($char);

            if ($pos >= 1536 && $pos <= 1791) {
                $arabic_count++;
            } else if($pos > 123 && $pos < 123) {
                $latin_count++;
            }
            $total_count++;
        }

        if (($arabic_count/$total_count) > 0.3) {
            // 30% arabic chars, its probably arabic
            // return true;
            $res = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=ar&tl=en&hl=hl&q=".urlencode($str), $_SERVER['DOCUMENT_ROOT']."/transes.html");
            $res = json_decode($res);

            if (isset($res[0][0][0])) {
                if (strlen($res[0][0][0]) > 35) {
                    return substr($res[0][0][0], 0, 35);
                }
                return $res[0][0][0];
            }
        }
    }

    public function uniord($u) { 
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8'); 

        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));

        return $k2 * 256 + $k1; 
    }

Magento\Quote\Model\ShippingMethodManagement

$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('IN');

// $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
// $logger = new \Zend\Log\Logger();
// $logger->addWriter($writer);
// $logger->info(print_r($this->translate($addressData[AddressInterface::KEY_CITY]), 1));
// $logger->info(print_r($address, 1));

$addressData[AddressInterface::KEY_CITY] = $this->translate($addressData[AddressInterface::KEY_CITY]);

app/code/Mageplaza/Osc/etc/webapi_rest/di.xml
app/code/Mageplaza/Osc/view/frontend/web/js/view/shipping.js
app/code/Mageplaza/Osc/view/frontend/web/js/view/amazon.js
app/code/Mageplaza/Osc/view/frontend/web/js/view/shipping-address/address-renderer/default.js
app/code/Mageplaza/Osc/view/frontend/web/js/model/shipping-rates-validator.js
app/code/Mageplaza/Osc/view/frontend/web/js/model/shipping-rate-service.js

webroot/almarjanstore/vendor/magento/module-quote/etc/webapi.xml

Dubai - دبي

/run/user/1001/gvfs/smb-share:server=10.16.16.8,share=abrar/webroot/almarjanstore/vendor/magento/module-quote/Model/ShippingMethodManagement.php

carts/mine/estimate-shipping-methods

vendor/magento/module-quote/Model/ShippingMethodManagement.php
estimateByExtendedAddress


    <route url="/V1/guest-carts/:cartId/estimate-shipping-methods" method="POST">
        <service class="Magento\Quote\Api\GuestShipmentEstimationInterface" method="estimateByExtendedAddress"/>
        <resources>
            <resource ref="anonymous" />
        </resources>
    </route>
V1/carts/mine/estimate-shipping-methods
