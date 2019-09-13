<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Message\Manager;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\Testimonial\Api\Data\TestimonialInterface;
use Training\Testimonial\Api\Data\TestimonialInterfaceFactory;
use Training\Testimonial\Api\TestimonialRepositoryInterface;
use Training\Testimonial\Controller\Adminhtml\Data;

class Save extends Data
{
    /**
     * @var Manager
     */
    protected $messageManager;

    /**
     * @var TestimonialRepositoryInterface
     */
    protected $testimonialRepository;

    /**
     * @var TestimonialInterfaceFactory
     */
    protected $testimonialFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        Registry $registry,
        TestimonialRepositoryInterface $testimonialRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Manager $messageManager,
        TestimonialInterfaceFactory $testimonialFactory,
        DataObjectHelper $dataObjectHelper,
        Context $context
    ) {
        $this->messageManager        = $messageManager;
        $this->testimonialFactory    = $testimonialFactory;
        $this->testimonialRepository = $testimonialRepository;
        $this->dataObjectHelper      = $dataObjectHelper;
        parent::__construct($registry, $testimonialRepository, $resultPageFactory, $resultForwardFactory, $context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data  = $this->getRequest()->getPostValue();
        $files = $this->getRequest()->getFiles();
        print_r($files);exit;
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $model = $this->testimonialRepository->getById($id);
            } else {
                unset($data['id']);
                $model = $this->testimonialFactory->create();
            }

            try {
                $this->dataObjectHelper->populateWithArray($model, $data, TestimonialInterface::class);
                $this->testimonialRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved this data.'));
                $this->_getSession()->setFormData(false);

                /**
                 * Save and continue on edit
                 */
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('testimonial/index/edit', ['id' => $model->getId(), '_current' => true]);
                }

                /**
                 * Return to list view after save
                 */
                return $resultRedirect->setPath('testimonial/index/listview');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('testimonial/index/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('testimonial/index/listview');
    }
}
