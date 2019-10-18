<?php

/**
 * Custom Data frontend block class.
 */

namespace Training\CustomProductContentTab\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Block\Product\Context;

/**
 * class CustomData
 * @package Training\CustomProductContentTab\Block
 */
class CustomData extends Template
{
    /**
     * [__construct description]
     * @param Context $context [description]
     * @param array   $data    [description]
     */
    public function __construct(
        Context $context,
        array $data = []
    )
    {
        $this->coreRegistry = $context->getRegistry();
        parent::__construct($context, $data);
    }

    /**
     * Retrieve current product object
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (!$this->hasData('product')) {
            $this->setData('product', $this->coreRegistry->registry('product'));
        }

        return $this->getData('product');
    }

    /**
     * @return string
     */
    public function getTabsContent()
    {
        $data = [
            'title' => $this->getProduct()->getCustomTitle(),
            'comment' => $this->getProduct()->getCustomComment()
        ];

        return $data;
    }

    /**
     * @return return HTML
     */
    protected function _toHtml()
    {
        if (!empty($this->getTabsContent())) {
            return parent::_toHtml();
        }

        return false;
    }
}
