<?php

namespace Ktpl\SpranksConfigurableTierPrices\Model\Config\Source;

/**
 * Category class
 * @package Ktpl\SpranksConfigurableTierPrices\Model\Config\Source
 */
class Category implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Category collection factory
     *
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    public $categoryCollectionFactory;

    /**
     * Construct
     *
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     */
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * Return option array
     *
     * @param bool $addEmpty
     * @return array
     */
    public function toOptionArray()
    {
        /** 
         * @var \Magento\Catalog\Model\ResourceModel\Category\Collection $collection 
         */
        $collection = $this->categoryCollectionFactory->create();

        $collection->addAttributeToSelect('name')->addFieldToFilter('level', array('gteq' => 1))->load();

        $options = [];

        $options[] = ['label' => __('-- Disable for no Category --'), 'value' => ''];

        if ($collection)
        {
            foreach ($collection as $category)
            {
                $label = $category->getName();

                /**
                 * Pad so that categories nesting structure is displayed correctly
                 */
                $padLength = ($category->getLevel() - 1) * 2 + strlen($label);
                
                $label = str_pad($label, $padLength, '-', STR_PAD_LEFT);

                $options[] = ['label' => $label, 'value' => $category->getId()];
            }
        }

        return $options;
    }
}
