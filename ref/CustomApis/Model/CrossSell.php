<?php

namespace Ktpl\CustomApis\Model;

use Ktpl\CustomApis\Api\CrossSellInterface;
use \Magento\Checkout\Model\Session as CheckoutSession;
use Magento\CatalogInventory\Helper\Stock as StockHelper;

/**
 * Cart crosssell list
 *
 * @api
 * @author KTPL
 * @since 100.0.2
 */ 
class CrossSell extends \Magento\Catalog\Block\Product\AbstractProduct implements CrossSellInterface
{
    
    /** @var CheckoutSession */
    // protected $checkoutSession;
    // protected $cart;
     protected $quoteRepository;
    // protected $_productLinkFactory;
    // protected $_itemRelationsList;

    /**
     * Items quantity will be capped to this value
     *
     * @var int
     */
    protected $_maxItemCount = 4;

    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;

    /**
     * @var \Magento\Catalog\Model\Product\Visibility
     */
    protected $_productVisibility;

    /**
     * @var StockHelper
     */
    protected $stockHelper;

    /**
     * @var \Magento\Catalog\Model\Product\LinkFactory
     */
    protected $_productLinkFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Item\RelatedProducts
     */
    protected $_itemRelationsList;

    protected $quoteFactory;

    /**
     *
     * @param CheckoutSession $checkoutSession
     * @param \Magento\Checkout\Model\Cart $cart
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param \Magento\Catalog\Model\Product\Visibility $productVisibility
     * @param \Magento\Catalog\Model\Product\LinkFactory $productLinkFactory
     * @param \Magento\Quote\Model\Quote\Item\RelatedProducts $itemRelationsList  
     * @param StockHelper $stockHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        CheckoutSession $checkoutSession,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Model\Product\LinkFactory $productLinkFactory,
        \Magento\Quote\Model\Quote\Item\RelatedProducts $itemRelationsList,
        StockHelper $stockHelper,
        array $data = []

    ) {
        $this->_checkoutSession = $checkoutSession;
        //$this->cart = $cart;
        $this->quoteFactory = $quoteFactory;
        $this->quoteRepository = $quoteRepository;
        $this->_productVisibility = $productVisibility;
        $this->_productLinkFactory = $productLinkFactory;
        $this->_itemRelationsList = $itemRelationsList;
        $this->stockHelper = $stockHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function name($name) {
        return "Hello, " . $name;
    }

    /**
     * Returns greeting message to user
     * 
     * @param int $quote Users name.
     * @return \Ktpl\CustomApis\Api\CrossSellInterface[]
     */
    public function getCrossByQuote($quote){
       $quoteObject = $this->quoteFactory->create()->load($quote);
       $items = $quoteObject->getAllItems();
       foreach ($items as $item) {
           $items = $item->getData('product_id');
           $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
           $_product = $objectManager->create('Magento\Catalog\Model\Product')->load($items);
           //$allItems[] = $_product->getCrossSellProducts();
           foreach ($_product->getCrossSellProducts() as $crossProducts) {
               $allItems[] = $crossProducts->getData();
           }
       }
       //print_r($allItems);die;
       return $allItems;
        

    }

    /**
     * Returns greeting message to user
     * 
     * @param int $quoteId Users name.
     * @return \Ktpl\CustomApis\Api\CrossSellInterface[]
     */
    public function getCrossProducts($quoteId){
       //$quoteIds = $this->quoteRepository->get($quoteId);
       $quoteObject = $this->quoteFactory->create()->load($quoteId);
       $items = $quoteObject->getAllVisibleItems();
       foreach ($items as $item) {
           $quotId[] = $item->getData('quote_id');
       }
       //$items = $this->getData('items');
       //($items === null)
        if ($quotId) {
            $items = [];
            $ninProductIds = $this->_getCartProductIds();
            // print_r($ninProductIds);
            // die;
            if ($ninProductIds) {
                $lastAdded = (int)$this->_getLastAddedProductId();
                if ($lastAdded) {
                    $collection = $this->_getCollection()->addProductFilter($lastAdded);
                    if (!empty($ninProductIds)) {
                        $collection->addExcludeProductFilter($ninProductIds);
                    }
                    $collection->setPositionOrder()->load();

                    foreach ($collection as $item) {
                        $ninProductIds[] = $item->getId();
                        $items[] = $item;
                    }
                }

                if (count($items) < $this->_maxItemCount) {
                    $filterProductIds = array_merge(
                        $this->_getCartProductIds(),
                        $this->_itemRelationsList->getRelatedProductIds($quoteObject->getAllItems())
                    );
                    $collection = $this->_getCollection()->addProductFilter(
                        $filterProductIds
                    )->addExcludeProductFilter(
                        $ninProductIds
                    )->setPageSize(
                        $this->_maxItemCount - count($items)
                    )->setGroupBy()->setPositionOrder()->load();
                    foreach ($collection as $item) {
                        //print_r($item->getData());die;
                        $items[] = $item->getData();
                    }
                }
            }

            $this->setData('quote_id', $items);
        }
        return $items;
        
    }

    /**
     * Count items
     *
     * @return int
     * @codeCoverageIgnore
     */
    public function getItemCount()
    {
        return count($this->getCrossProducts());
    }

    /**
     * Get ids of products that are in cart
     *
     * @return array
     */
    protected function _getCartProductIds()
    {
        $ids = $this->getData('_cart_product_ids');
        if ($ids === null) {
            $ids = [];
            foreach ($this->getQuote()->getAllItems() as $item) {
                $product = $item->getProduct();
                if ($product) {
                    $ids[] = $product->getId();
                }
            }
            $this->setData('_cart_product_ids', $ids);
        }
        return $ids;
    }

    /**
     * Get last product ID that was added to cart and remove this information from session
     *
     * @return int
     * @codeCoverageIgnore
     */
    protected function _getLastAddedProductId()
    {
        return $this->_checkoutSession->getLastAddedProductId(true);
    }

    /**
     * Get quote instance
     *
     * @return \Magento\Quote\Model\Quote
     * @codeCoverageIgnore
     */
    public function getQuote()
    {
        return $this->_checkoutSession->getQuote();
    }

    /**
     * Get crosssell products collection
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection
     */
    protected function _getCollection()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Link\Product\Collection $collection */
        $collection = $this->_productLinkFactory->create()->useCrossSellLinks()->getProductCollection()->setStoreId(
            $this->_storeManager->getStore()->getId()
        )->addStoreFilter()->setPageSize(
            $this->_maxItemCount
        )->setVisibility(
            $this->_productVisibility->getVisibleInCatalogIds()
        );
        $this->_addProductAttributesAndPrices($collection);

        return $collection;
    }
}
