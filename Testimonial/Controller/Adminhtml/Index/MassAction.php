<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Training\Testimonial\Api\TestimonialRepositoryInterface;
use Training\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;

abstract class MassAction extends \Training\Testimonial\Controller\Adminhtml\Data
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var TestimonialRepositoryInterface
     */
    protected $testimonialRepository;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var string
     */
    protected $successMessage;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * MassAction constructor.
     *
     * @param Filter $filter
     * @param Registry $registry
     * @param TestimonialRepositoryInterface $testimonialRepository
     * @param PageFactory $resultPageFactory
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param ForwardFactory $resultForwardFactory
     * @param $successMessage
     * @param $errorMessage
     */
    public function __construct(
        Filter $filter,
        Registry $registry,
        TestimonialRepositoryInterface $testimonialRepository,
        PageFactory $resultPageFactory,
        Context $context,
        CollectionFactory $collectionFactory,
        ForwardFactory $resultForwardFactory,
        $successMessage,
        $errorMessage
    ) {
        $this->filter                = $filter;
        $this->testimonialRepository = $testimonialRepository;
        $this->collectionFactory     = $collectionFactory;
        $this->resultForwardFactory  = $resultForwardFactory;
        $this->successMessage        = $successMessage;
        $this->errorMessage          = $errorMessage;
        parent::__construct($registry, $testimonialRepository, $resultPageFactory, $resultForwardFactory, $context);
    }

    /**
     * @param Testimonial $testimonial
     * @return mixed
     */
    abstract protected function massAction(\Training\Testimonial\Model\Testimonial $testimonial);

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection     = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $data) {
                $this->massAction($data);
            }
            $this->messageManager->addSuccessMessage(__($this->successMessage, $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($this->errorMessage));
        }
        $redirectResult = $this->resultRedirectFactory->create();
        $redirectResult->setPath('testimonial/index/listview');
        return $redirectResult;
    }
}
