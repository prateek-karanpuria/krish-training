<?php

/**
 * Featured Product to be displayed in top links
 */

namespace Training\FeaturedProduct\Block;

use Magento\Framework\View\Element\Html\Link;
use Magento\Framework\View\Element\Template\Context;

/**
 * class FeaturedLink
 * @package Training\FeaturedProduct\Block
 */
class FeaturedLink extends Link
{
    /**
    * @param \Magento\Framework\View\Element\Template\Context $context
    * @param array                                            $data   
    */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * [_toHtml description]
     * @return new li
     */
    protected function _toHtml()
    {
        if ($this->getTemplate()) {
            return parent::_toHtml();
        } else {
            //return '<li><a '. $this->getLinkAttributes().'>' .$this->escapeHtml($this->getLabel()).'<a></li>';
            return '<li><a href="'.$this->getBaseUrl().'featuredproducts/?featured_product=1">' .$this->escapeHtml($this->getLabel()).'<a></li>';
        }
    }
}
