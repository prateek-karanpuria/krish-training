<?php


namespace Ktpl\ShippingDate\Controller\Adminhtml\Holiday;

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
            $id = $this->getRequest()->getParam('holiday_id');
        
            $model = $this->_objectManager->create(\Ktpl\ShippingDate\Model\Holiday::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Holiday no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $website = implode(",",$data["website_id"]);
            $data["website_id"] = $website;
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Holiday.'));
                $this->dataPersistor->clear('ktpl_shippingdate_holiday');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['holiday_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Holiday.'));
            }
        
            $this->dataPersistor->set('ktpl_shippingdate_holiday', $data);
            return $resultRedirect->setPath('*/*/edit', ['holiday_id' => $this->getRequest()->getParam('holiday_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
