<?php


namespace Reciproci\CommitApis\Controller\Adminhtml\Reciprociordersapi;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('reciproci_orders_api_id');
        
            $model = $this->_objectManager->create(\Reciproci\CommitApis\Model\ReciprociOrdersApi::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Reciproci Orders Api no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Reciproci Orders Api.'));
                $this->dataPersistor->clear('reciproci_commitapis_reciproci_orders_api');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['reciproci_orders_api_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Reciproci Orders Api.'));
            }
        
            $this->dataPersistor->set('reciproci_commitapis_reciproci_orders_api', $data);
            return $resultRedirect->setPath('*/*/edit', ['reciproci_orders_api_id' => $this->getRequest()->getParam('reciproci_orders_api_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
