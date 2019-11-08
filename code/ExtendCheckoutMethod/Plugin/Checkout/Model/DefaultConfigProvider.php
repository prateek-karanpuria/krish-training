<?php
namespace Krish\ExtendCheckoutMethod\Plugin\Checkout\Model;

use Magento\Checkout\Model\Session as CheckoutSession;

class DefaultConfigProvider
{
    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;
    /**
     * Constructor
     *
     * @param CheckoutSession $checkoutSession
     */

    public function __construct(
        CheckoutSession $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }

    public function afterGetConfig(
        \Magento\Checkout\Model\DefaultConfigProvider $subject,
        array $result
    ) {
        $items = $result['totalsData']['items'];
        for($i=0; $i<count($items);$i++){

            $quoteId = $items[$i]['item_id'];
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $quote = $objectManager->create('\Magento\Quote\Model\Quote\Item')->load($quoteId);
            $productId = $quote->getProductId();
            $product = $objectManager->create('\Magento\Catalog\Model\Product')->load($productId);
            $blockData = $objectManager->create('Suttonsilver\Themeoptions\Block\Brands\Cart'); 
             $brandData = $blockData->productsByAttribute($product->getBrandpagesBrand());
             
             $productFlavours = $product->getResource()->getAttribute('brandpages_brand')->getSource()->getOptionText($product->getBrandpagesBrand()); 

             $items[$i]['brandpages_brand'] = $productFlavours;
        }

        $result['totalsData']['items'] = $items;
        
        return $result;
    }
}
  

           
          