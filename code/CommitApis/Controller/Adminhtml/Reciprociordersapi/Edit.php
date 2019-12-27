<?php


namespace Reciproci\CommitApis\Controller\Adminhtml\Reciprociordersapi;

class Edit extends \Reciproci\CommitApis\Controller\Adminhtml\Reciprociordersapi
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('reciproci_orders_api_id');
        $model = $this->_objectManager->create(\Reciproci\CommitApis\Model\ReciprociOrdersApi::class);
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Reciproci Orders Api no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('reciproci_commitapis_reciproci_orders_api', $model);
        
        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Reciproci Orders Api') : __('New Reciproci Orders Api'),
            $id ? __('Edit Reciproci Orders Api') : __('New Reciproci Orders Api')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Reciproci Orders Apis'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Reciproci Orders Api %1', $model->getId()) : __('New Reciproci Orders Api'));
        return $resultPage;
    }
}
