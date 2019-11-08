<?php

namespace Krish\ExtendCheckoutMethod\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\View\LayoutInterface;

class ConfigProvider implements ConfigProviderInterface
{
    /** @var LayoutInterface  */
    protected $_layout;

    public function __construct(LayoutInterface $layout)
    {
        $this->_layout = $layout;
    }

    public function getConfig()
    {
        $ShippingBlockId = "shipping_text";

        return [
            'my_block_content' => $this->_layout->createBlock('Magento\Cms\Block\Block')->setBlockId($ShippingBlockId)->toHtml()
        ];
    }
}