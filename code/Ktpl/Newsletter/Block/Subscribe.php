<?php

namespace Ktpl\Newsletter\Block;

/**
 * Referenced from Magento\Newsletter\Block\Subscribe
 */

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

    /**
     * [__construct description]
     * @param Template\Context $context
     * @param Data             $scopeConfig
     * @param array            $data
     */
    public function __construct(
        Template\Context $context,
        Data $scopeConfig,
        array $data = []
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * [getFormActionUrl description]
     * @return form action URL
     */
    public function getFormActionUrl()
    {
        return $this->getUrl('newsletter_popup/subscriber/new', ['_secure' => true]);
    }
}
