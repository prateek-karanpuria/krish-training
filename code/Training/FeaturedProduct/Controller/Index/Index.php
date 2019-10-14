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
        $result = $this->pageFactory->create();
        $param = $this->request->getParams();

        $this->collectionFactory->addFieldToSelect('*');

        if (array_key_exists('featured_product', $param) || empty($param)) {
            $this->collectionFactory->addFieldToFilter('featured_product', ['eq' => 1]);

        } else {
            foreach ($param as $key => $value) {
                if ($key == 'cat') {
                   $catalog_ids = explode(',', $value);
                   $this->collectionFactory->addCategoriesFilter(array('in' => $catalog_ids));

                } else if ($key == 'product_list_dir') {
                    $this->collectionFactory->setOrder($value);

                } else if ($key == 'p' || $key == 'product_list_limit' || $key == 'product_list_order') {
                    $this->collectionFactory->addFieldToSelect('*');

                } else {
                    $this->collectionFactory->addFieldToSelect('*');
                    $this->collectionFactory->addFieldToFilter($key, ['eq' => $value]);
                }
            }
        }

        /**
         * [$list description]
         * @var Training\FeaturedProduct\Block\Index
         */
        $list = $result->getLayout()->getBlock('category.products.list');
        $list->setProductCollection($this->collectionFactory);

        return $result;
    }
}
