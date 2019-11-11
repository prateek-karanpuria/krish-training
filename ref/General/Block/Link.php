<?php
namespace Ktpl\General\Block;

class Link extends \Magento\Framework\View\Element\Html\Link
{
    /**
    * Render block HTML.
    *
    * @return string
    */
    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }

        $class = 'class="'.$this->getAttributes()["class"].'"';
        return '<li class="'.$this->getParentclass().'"><a ' . $this->getLinkAttributes() . ' ' .$class.' ><span>' . $this->escapeHtml($this->getLabel()) . '</span></a></li>';
    }
}