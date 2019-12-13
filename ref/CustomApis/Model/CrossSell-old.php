<?php

namespace Ktpl\CustomApis\Model;

use Ktpl\CustomApis\Api\CrossSellInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\CatalogInventory\Helper\Stock as StockHelper;

/**
 * Cart crosssell list
 *
 * @api
 * @author KTPL
 * @since 100.0.2
 */
class CrossSell implements CrossSellInterface
{
    protected $cart;

    protected $quoteRepository;
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
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Model\Product\LinkFactory $productLinkFactory,
        \Magento\Quote\Model\Quote\Item\RelatedProducts $itemRelationsList,
        StockHelper $stockHelper,
        array $data = []

    ) {
        $this->cart = $cart;
        $this->quoteFactory = $quoteFactory;
        $this->quoteRepository = $quoteRepository;
        $this->_productVisibility = $productVisibility;
        $this->_productLinkFactory = $productLinkFactory;
        $this->_itemRelationsList = $itemRelationsList;
        $this->stockHelper = $stockHelper;
    }

    /**
     * Returns greeting message to user
     *
     * @param int $quote Users name.
     * @return \KTPL\CustomApi\Api\CrossSellInterface[]
     */
    public function getCrossByQuote($quote){

        $quote = $this->quoteRepository->get($quote);
        $items = $quote->getAllItems();
        foreach ($items as $item){
            echo $item->getProductId();
        }
        die;
        //return $allItems;

    }

}
