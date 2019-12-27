<?php


namespace Reciproci\CommitApis\Controller\Adminhtml\Reciprocideliveryapi;

class Delete extends \Reciproci\CommitApis\Controller\Adminhtml\Reciprocideliveryapi
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('reciproci_delivery_api_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Reciproci\CommitApis\Model\ReciprociDeliveryApi::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Reciproci Delivery Api.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['reciproci_delivery_api_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Reciproci Delivery Api to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
