<?php

/**
 * Display product collection in Featured Product module
 */

namespace Training\FeaturedProduct\Block;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;

/**
 * class Index
 * @package Training\FeaturedProduct\Block\Index
 */
class Index extends ListProduct
{
    /**
     * [getLoadedProductCollection description]
     * @return [type] [description]
     */
    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
    }

    /**
     * [setProductCollection description]
     * @param AbstractCollection $collection [description]
     */
    public function setProductCollection(AbstractCollection $collection)
    {
        $this->_productCollection = $collection;
    }
}
