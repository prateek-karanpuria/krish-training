<?php
namespace Ktpl\General\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
class Category extends AbstractHelper {

    protected $_registry;
    protected $_categoryFactory;
    protected $_urlInterface;
    protected $_storeManager;
    protected $_reviewFactory;
    protected $_productRepository;     
    /**
     * Data constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Review\Model\Review $reviewFactory,
        \Magento\Framework\UrlInterface $urlInterface,
        ProductRepositoryInterface $productRepository
    ) {
        $this->_registry = $registry;
        $this->_categoryFactory = $categoryRepository;
        $this->_storeManager = $storeManager;
        $this->_reviewFactory = $reviewFactory;
        $this->_urlInterface = $urlInterface;
        $this->_productRepository = $productRepository;
    }

    public function getChildCategories(){
        if ($this->getCurrentCategory()) {
            return $this->getCurrentCategory()->getChildrenCategories();
        }
        return "";
    }

    public function isAddAlltoCartCategory(){
        $category = $this->getCurrentCategory();
        if ($category) {
            if($category->getIncludeInMenu() == 0){
                return true;
            }
        }
        return false;
    }

    public function getRatingSummary($product){
        $this->_reviewFactory->getEntitySummary($product, $this->_storeManager->getStore()->getId());
        return $product;
    }

    public function loadCategoryById($categoryId){
        return $this->_categoryFactory->get($categoryId, $this->_storeManager->getStore()->getId());
    }

    public function getControllerActionUrl()
    {
        return $this->_urlInterface->getUrl('generalaction/index/productlist');
    }

    public function getCurrentCategory(){
        return $this->_registry->registry('current_category');
    }

    public function getProductById($productId){
      return $product = $this->_productRepository->getById($productId);
    }

}