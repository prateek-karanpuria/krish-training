<?php

namespace Ktpl\SpranksConfigurableTierPrices\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Attribute code length must be less than 30 symbols
     */
    const ATTRIBUTE_DISABLED_FOR_PRODUCT = 'configtierprices_disabled';
}
