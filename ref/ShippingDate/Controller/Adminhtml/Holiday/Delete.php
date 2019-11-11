<?php


namespace Ktpl\ShippingDate\Controller\Adminhtml\Holiday;

class Delete extends \Ktpl\ShippingDate\Controller\Adminhtml\Holiday
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
        $id = $this->getRequest()->getParam('holiday_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Ktpl\ShippingDate\Model\Holiday::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Holiday.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['holiday_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Holiday to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
