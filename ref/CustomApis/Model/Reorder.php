<?php

namespace Ktpl\CustomApis\Model;

use Ktpl\CustomApis\Api\ReorderInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Sales\Model\OrderRepository;
use Magento\Quote\Model\Quote;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Quote\Api\Data\CartItemInterface;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Quote\Api\CartItemRepositoryInterface;

class Reorder implements ReorderInterface
{
    protected $quoteRepository;

    protected $orderRepository;

    protected $quote;

    protected $productRepository;

    protected $cartItemInterface;

    protected $cartInterface;

    protected $cartItemRepository;

    protected $_customerRepositoryInterface;

    protected $_cartManagementInterface;

    protected $cartRepositoryInterface;

    protected $productOption;
    protected $cart;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        CartRepositoryInterface $quoteRepository,
        OrderRepository $orderRepository,
        Quote $quote,
        ProductRepositoryInterface $productRepository,
        CartItemInterface $cartItemInterface,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        CartItemRepositoryInterface $cartItemRepository,
        CartInterface $cartInterface,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Quote\Api\CartManagementInterface $cartManagementInterface,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\Quote\Api\Data\ProductOptionInterface $productOption,
        \Magento\Checkout\Model\Cart $cart
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->orderRepository = $orderRepository;
        $this->quote = $quote;
        $this->productRepository = $productRepository;
        $this->cartItemInterface = $cartItemInterface;
        $this->cartInterface = $cartInterface;
        $this->cartItemRepository = $cartItemRepository;
        $this->_storeManager = $storeManager;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_cartManagementInterface = $cartManagementInterface;
        $this->cartRepositoryInterface=$cartRepositoryInterface;
        $this->productOption=$productOption;
        $this->cart=$cart;
    }


    /**
     * @param $cartId
     * @param $orderId
     * @return bool
     */
    public function createReorder($cartId,$orderId)
    {
        //echo $cartId;die;
        //$quoteRepo = $this->quoteRepository->getActive($cartId);
        $order = $this->orderRepository->get($orderId);
        //$cart = $this->cartItemInterface;
        $cart = $this->cart;
        $items = $order->getItemsCollection();
        //echo "<pre>";print_r($items->getData()); die;
        foreach ($items as $item) {
            //echo "<pre>";print_r($item->getQuoteItemId()); die;
            try {
              $cart->addOrderItem($item, $cartId);
              //$this->cart->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                return false;

            }
        }

        return true;
    }

    public function addOrderItem($orderItem,$quoteId)
    {
        /* @var $orderItem \Magento\Sales\Model\Order\Item */
        if ($orderItem->getParentItem() === null) {
            //$storeId = $this->_storeManager->getStore()->getId();
            try {
                /**
                 * We need to reload product in this place, because products
                 * with the same id may have different sets of order attributes.
                 */
                $product = $this->productRepository->getById($orderItem->getProductId());

            } catch (NoSuchEntityException $e) {
                return $this;
            }
            //echo $orderItem->getPrice();die;
            $this->cartItemInterface->setQuoteId($quoteId);
            $this->cartItemInterface->setSku($product->getSku());
            $this->cartItemInterface->setQty($orderItem->getQtyOrdered());
            $this->cartItemInterface->setPrice($orderItem->getPrice());
            //echo "<pre>"; print_r($this->cartItemInterface->getData());die;
            $this->cartItemRepository->save($this->cartItemInterface);
            $this->cart->save();
        }
    }

    protected function _getProduct($productInfo)
    {
        $product = null;
        if ($productInfo instanceof Product) {
            $product = $productInfo;
            if (!$product->getId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __("The product wasn't found. Verify the product and try again.")
                );
            }
        } elseif (is_int($productInfo) || is_string($productInfo)) {
            $storeId = $this->_storeManager->getStore()->getId();
            try {
                $product = $this->productRepository->getById($productInfo, false, $storeId);
            } catch (NoSuchEntityException $e) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __("The product wasn't found. Verify the product and try again."),
                    $e
                );
            }
        } else {
            throw new \Magento\Framework\Exception\LocalizedException(
                __("The product wasn't found. Verify the product and try again.")
            );
        }
        $currentWebsiteId = $this->_storeManager->getStore()->getWebsiteId();
        if (!is_array($product->getWebsiteIds()) || !in_array($currentWebsiteId, $product->getWebsiteIds())) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __("The product wasn't found. Verify the product and try again.")
            );
        }
        return $product;
    }
}
