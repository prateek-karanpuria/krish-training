<?php


namespace Ktpl\ShippingDate\Model;

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
        return [
            'shipping_date_content' => $this->_layout->createBlock('Ktpl\ShippingDate\Block\Shippingdate')->setTemplate("Ktpl_ShippingDate::shippingdate.phtml")->toHtml()
        ];
    }
}