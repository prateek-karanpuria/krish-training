<?php


namespace Ktpl\Timeslot\Controller\Adminhtml\Timeslot;

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
            $id = $this->getRequest()->getParam('timeslot_id');
            if($data['region'] != "")
            {
                $data['state_id'] = $data['region'];
                $data['region'] = "";
            }
            $model = $this->_objectManager->create(\Ktpl\Timeslot\Model\Timeslot::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Timeslot no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        
            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Timeslot.'));
                $this->dataPersistor->clear('ktpl_timeslot_timeslot');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['timeslot_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Timeslot.'));
            }
        
            $this->dataPersistor->set('ktpl_timeslot_timeslot', $data);
            return $resultRedirect->setPath('*/*/edit', ['timeslot_id' => $this->getRequest()->getParam('timeslot_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
