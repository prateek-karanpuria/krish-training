<?php
namespace Ktpl\General\Block;

class Reorder extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;
    protected $_helper;
    protected $_httpContext;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_httpContext = $httpContext;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function isLoggedIn()
    {
        $isLoggedIn = $this->_httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        return $isLoggedIn;
    }
}