<?php

/**
 * Featured Product Index controller
 */

namespace Training\FeaturedProduct\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\Http;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

/**
 * class Index
 * @package Training\FeaturedProduct\Controller\Index\Index
 */
class Index extends Action
{
    /** 
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @var Http
     */
    protected $httpRequest;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * [__construct description]
     * @param Context           $context           [description]
     * @param PageFactory       $pageFactory       [description]
     * @param Http              $httpRequest           [description]
     * @param CollectionFactory $collectionFactory [description]
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Http $httpRequest,
        CollectionFactory $collectionFactory
    )
    {
        $this->pageFactory = $pageFactory;
        $this->request = $httpRequest;
        $this->collectionFactory = $collectionFactory->create();
        parent::__construct($context);
    }

    /**
     * [execute description]
     * @return result with filtered list
     */
    public function execute()
    {
        $pageFactory = $this->pageFactory->create();
        $params = $this->request->getParams();

        $this->collectionFactory->addFieldToSelect('*');

        /**
         * Filter params array to skip conditions
         */
        $skipFieldFilter = array(
            'p',
            'product_list_mode',
            'product_list_limit',
            'product_list_order',
        );
        
        $params = array_filter($params, function($key) use ($skipFieldFilter) {
            if (!in_array($key, $skipFieldFilter)) {
               return $key;
            }
        }, ARRAY_FILTER_USE_KEY);

        $this->collectionFactory->addFieldToFilter('featured_product', ['eq' => 1]);

        /**
         * Set collection filter to be applied before rendering the collection in block
         */
        if ($params) {
            foreach ($params as $key => $value) {
                if (strpos($value, '-') !== false) {
                    $values = explode('-', $value);

                    // Greater than - gt 
                    if ($values[0]) $this->collectionFactory->addFieldToFilter($key, ['gt' => $values[0]]);
                    
                    // Less than - lt
                    if ($values[1]) $this->collectionFactory->addFieldToFilter($key, ['lt' => $values[1]]);

                } else if ($key == 'product_list_dir') {
                    $this->collectionFactory->setOrder($value);
  
                } else if ($key == 'cat') {
                   $catalog_ids = explode(',', $value);
                   $this->collectionFactory->addCategoriesFilter(array('eq' => $catalog_ids));

                } else if (!in_array($key, $skipFieldFilter)) {
                    $this->collectionFactory->addFieldToFilter($key, ['eq' => $value]);

                }

            }
        }

        /**
         * [$list description]
         * @var Training\FeaturedProduct\Block\Index
         */
        $list = $pageFactory->getLayout()->getBlock('category.products.list');
        $collection = $list->setProductCollection($this->collectionFactory);
        
        /**
         * Set page title
         */
        $pageFactory->getConfig()->getTitle()->set("Featured Products");

        return $pageFactory;
    }
}
