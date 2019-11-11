<?php
namespace Ktpl\General\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class ProductList extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_productCollectionFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
	)
	{
		$this->_pageFactory = $pageFactory;	
		$this->_productCollectionFactory = $productCollectionFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		$response = array();
		$post = (array) $this->getRequest()->getPost();
		if(!empty($post)) {
			try {
    			$categoryId = trim($post["categoryId"]);

				$collection = $this->_productCollectionFactory->create();
		        $collection->addAttributeToSelect('*');
		        $collection->addCategoriesFilter(['in' => $categoryId])
		        ->addAttributeToFilter('visibility', \Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH)
                ->addAttributeToFilter('status', \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);

				$resultPage = $this->_pageFactory->create();
				$blockHtml = $resultPage->getLayout()
	                ->createBlock('Magento\Catalog\Block\Product\ListProduct')
	                ->setCollection($collection)
	                ->setTemplate('Ktpl_General::default/productList.phtml');
	                
	            $response["html"] = $blockHtml->toHtml();
	            $response["status"] = "success";
		    } catch (\Exception $e) {
				$response["html"] = $e->getMessage();
	            $response["status"] = "error";
		    }			
		}
        $this->getResponse()->setBody(json_encode($response));
        return;
//		echo json_encode($response);
	}
}