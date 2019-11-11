<?php
namespace Ktpl\General\Controller\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;

class AddAlltoCart extends \Magento\Framework\App\Action\Action
{
    protected $formKey;   
    protected $cart;
	protected $productRepository;
	protected $_messageManager;
	protected $resultJsonFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Checkout\Model\Cart $cart,
		ProductRepositoryInterface $productRepository,
		\Magento\Framework\Message\ManagerInterface $messageManager,
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        array $data = []
	)
	{
		$this->formKey = $formKey;
        $this->cart = $cart;
		$this->productRepository = $productRepository;
    	$this->_messageManager = $messageManager;
		$this->resultJsonFactory = $resultJsonFactory;
		return parent::__construct($context);
	}

	protected function _initProduct($productId)
    {
       // $productId = (int)$this->getRequest()->getParam('product');
        if ($productId) {
            $storeId = $this->_objectManager->get(
                \Magento\Store\Model\StoreManagerInterface::class
            )->getStore()->getId();
            try {
                return $this->productRepository->getById($productId, false, $storeId);
            } catch (NoSuchEntityException $e) {
                return false;
            }
        }
        return false;
    }


	public function execute()
	{
		$response = array();
		$selectedItems = $this->getRequest()->getPost('formdata');

		if(!empty($selectedItems)) {
			try {
				$issingle = $this->getRequest()->getPost('issingle');
				if(!empty($issingle)){
					$productItems[$issingle] = $selectedItems[$issingle];	
				}else{
					$productItems = $selectedItems;
				}

				$i = 0;
				foreach ($productItems as $key => $selectedItem) {
					try {

						if(!empty($issingle)){

							if ($selectedItem['type']  == "simple" && (empty($selectedItem['qty']) || $selectedItem['qty'])) {
								$selectedItem['qty'] = 1;		
							}elseif($selectedItem['type']  == "grouped" && $selectedItem['type'] == "grouped" && !empty($selectedItem['grpchild'])){
								foreach ($selectedItem['super_group'] as $key => $grpOptions) {
									if(empty($grpOptions)){
										$selectedItem['super_group'][$selectedItem['grpchild']] = 1;
										break;
									}
								}
							}
						}

						if ($selectedItem['type']  == "simple" && (!empty($selectedItem['qty']) || $selectedItem['qty'] > 0)) {
				            $params = array(
				                'form_key' => $this->formKey->getFormKey(),
				                'product_id' => $selectedItem['id'],
				                'qty'   => $selectedItem['qty']            
				            );
							if (isset($params['qty'])) {
				                $filter = new \Zend_Filter_LocalizedToNormalized(
				                    ['locale' => $this->_objectManager->get(
				                        \Magento\Framework\Locale\ResolverInterface::class
				                    )->getLocale()]
				                );
				                $params['qty'] = $filter->filter($params['qty']);
				            }
				            $_product = $this->_initProduct($selectedItem['id']);       
				            $i++;
				            $this->cart->addProduct($_product, $params);			           
						}elseif ($selectedItem['type'] == "grouped" && !empty($selectedItem['grpchild'])) {

							foreach ($selectedItem['super_group'] as $key => $grpOptions) {
								if(empty($grpOptions)){
									$selectedItem['super_group'][$key] = 0;
								}
							}
							$params = array(
				                'form_key' => $this->formKey->getFormKey(),
				                'product' => $selectedItem['id'], //product Id
				                'qty'   => '1', //quantity of product
								'super_group' => $selectedItem['super_group']
				            );
				            $_product = $this->_initProduct($selectedItem['id']);   
				            $i++;
				            $this->cart->addProduct($_product, $params);
						}
					} catch (\Exception $e) {
						$this->_messageManager->addErrorMessage(__("%1",$e->getMessage()));
						continue;
		    		}	
		        }
				$this->cart->save();
				
		        if ($i < 1) {
		        	$this->_messageManager->addErrorMessage(__('Please select quantity first.'));
					$response["html"] = 'Please select quantity first.';
	            	$response["status"] = "error";
				}else{
                    $this->_messageManager->addSuccessMessage(__('Product(s) Added to Cart Successfully.'));
					$response["html"] = 'Product(s) Added to Cart Successfully.';
	            	$response["status"] = "success";
				}
				$status = 1;
		    } catch (\Exception $e) {
		    	$this->_messageManager->addErrorMessage(__("%1",$e->getMessage()));
				$response["html"] = $e->getMessage();
	            $response["status"] = "error";
		    }			
		}
    	return  $this->resultJsonFactory->create()->setData(['response' => $response]);
	}
}