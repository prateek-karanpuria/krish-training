<?php
namespace Ktpl\General\Block\Cart;

class Minicart extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;
    protected $_helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Ktpl\General\Helper\Data $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_helper = $helper;
        $this->_storeManager = $storeManager;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getHelper(){
        return $this->_helper;
    }
}