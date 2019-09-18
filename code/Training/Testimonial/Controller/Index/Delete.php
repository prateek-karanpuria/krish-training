<?php

namespace Training\Testimonial\Controller\Index;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\UrlInterface;
use Training\Testimonial\Helper\Data;
use Training\Testimonial\Model\TestimonialFactory;

/**
 * Class Delete
 * @package Training\Testimonial\Controller\Index
 */
class Delete extends Action
{
    /**
     * @var TestimonialFactory
     */
    protected $_testimonialFactory;

    /**
     * @var Data
     */
    protected $_helperData;

    /**
     * @var UrlInterface
     */
    protected $_urlInterface;

    /**
     * Delete constructor.
     * @param Context $context
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(
        Context $context,
        UrlInterface $urlInterface,
        Data $helperData,
        TestimonialFactory $testimonialFactory
    ) {
        $this->_helperData         = $helperData;
        $this->_urlInterface       = $urlInterface;
        $this->_testimonialFactory = $testimonialFactory;

        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     * @throws Exception
     */
    public function execute()
    {
        if ($this->_helperData->getGeneralConfig('module_enable')) {

            $action   = $this->getRequest()->getParam('action');
            $recordId = $this->getRequest()->getParam('record');

            /**
             * Soft Testimonial Delete => deleted = 1
             */
            if ($action == 'remove' && $recordId) {
                $testimonial = $this->_testimonialFactory->create();

                $input = [
                    'id'      => $recordId,
                    'deleted' => 1,
                ];

                try {
                    $testimonial->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__('Record removed successfully.'));
                } catch (Exception $exception) {
                    $this->messageManager->addErrorMessage(__('Record removed failed.'));
                }
            }

            /**
             * Hard Testimonial Delete => physical record delete
             */
            if ($action == 'delete' && $recordId) {
                $testimonial = $this->_testimonialFactory->create();

                $input = [
                    'id' => $recordId,
                ];

                try {
                    $testimonial->setData($input)->delete();
                    $this->messageManager->addSuccessMessage(__('Record deleted successfully.'));
                } catch (Exception $exception) {
                    $this->messageManager->addErrorMessage(__('Record deletion failed.'));
                }
            }

            $this->_redirect('testimonial/index/listview');

        } else {
            $this->_redirect($this->_urlInterface->getBaseUrl());
        }
    }
}
