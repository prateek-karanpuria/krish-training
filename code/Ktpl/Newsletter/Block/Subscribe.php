<?php

namespace Ktpl\Newsletter\Block;

/**
 * Subscribe form block class
 * Extended from Magento\Newsletter\Block\Subscribe
 */

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Ktpl\Newsletter\Helper\Data;

/**
 * Subscribe class
 * @package Ktpl\Newsletter\Block
 */
class Subscribe extends Template
{
    /**
     * @var Data
     */
    public $scopeConfig;

    public function __construct(
        Data $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Retrieve form action url and set "secure" param to avoid confirm
     * message when we submit form from secure page to unsecure
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('newsletter/subscriber/new', ['_secure' => true]);
    }
}
