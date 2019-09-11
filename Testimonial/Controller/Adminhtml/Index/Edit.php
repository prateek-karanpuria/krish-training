<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Training\Testimonial\Controller\Adminhtml\Data;

/**
 * Edit class
 * @package Training\Testimonial\Controller\Adminhtml\Index\Edit
 */
class Edit extends Data
{

    /**
     * @return mixed
     */
    public function execute()
    {

        $dataId     = $this->getRequest()->getParam('id');
        $resultPage = $this->resultPageFactory->create();

        $resultPage->setActiveMenu('Training_Testimonial::testimonial_list')
            ->addBreadcrumb(__('Data'), __('Data'))
            ->addBreadcrumb(__('Manage Data'), __('Manage Data'));

        if ($dataId === null) {
            $resultPage->addBreadcrumb(__('New Testimonial'), __('New Testimonial'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Testimonial'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Testimonial'), __('Edit Testimonial'));
            $resultPage->getConfig()->getTitle()->prepend(
                $this->testimonialRepository->getById($dataId)->getName()
            );
        }

        return $resultPage;
    }
}
