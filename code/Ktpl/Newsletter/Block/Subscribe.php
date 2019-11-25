<?php

namespace Ktpl\Newsletter\Block;

/**
 * Subscribe form block class
 * Extended from Magento\Newsletter\Block\Subscribe
 */

use Magento\Newsletter\Block\Subscribe as Newsletter_Subscribe;
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
        Template\Context $context,
        Data $scopeConfig,
        array $data = []
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getFormActionUrl()
    {
        return $this->getUrl('newsletter/subscriber/new', ['_secure' => true]);
    }
}
