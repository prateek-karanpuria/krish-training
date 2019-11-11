<?php
namespace Ktpl\General\Block;

class ProductPrice extends \Magento\Framework\View\Element\Template
{
    protected $_storeManager;
    protected $_productRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, 
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_productRepository = $productRepository;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getProductById($productId){
        return $this->_productRepository->getById($productId);
    }
}