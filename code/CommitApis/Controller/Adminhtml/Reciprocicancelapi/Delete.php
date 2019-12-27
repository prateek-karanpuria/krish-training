<?php


namespace Reciproci\CommitApis\Controller\Adminhtml\Reciprocicancelapi;

class Delete extends \Reciproci\CommitApis\Controller\Adminhtml\Reciprocicancelapi
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
        $id = $this->getRequest()->getParam('reciproci_cancel_api_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Reciproci\CommitApis\Model\ReciprociCancelApi::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Reciproci Cancel Api.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['reciproci_cancel_api_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Reciproci Cancel Api to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
