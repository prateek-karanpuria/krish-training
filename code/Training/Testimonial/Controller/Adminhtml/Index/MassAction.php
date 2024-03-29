<?php

namespace Training\Testimonial\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Training\Testimonial\Api\TestimonialRepositoryInterface;
use Training\Testimonial\Controller\Adminhtml\Data;
use Training\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Training\Testimonial\Model\Testimonial as DataModel;


abstract class MassAction extends Data
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var testimonial
     */
    protected $testimonial;

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
     * @param DataRepositoryInterface $dataRepository
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
        DataModel $testimonial,
        $successMessage,
        $errorMessage
    ) {
        $this->filter                = $filter;
        $this->testimonialRepository = $testimonialRepository;
        $this->collectionFactory     = $collectionFactory;
        $this->resultForwardFactory  = $resultForwardFactory;
        $this->successMessage        = $successMessage;
        $this->testimonial           = $testimonial;
        $this->errorMessage          = $errorMessage;
        parent::__construct($registry, $testimonialRepository, $resultPageFactory, $resultForwardFactory, $context);
    }

    /**
     * @param DataModel $data
     * @return mixed
     */
    abstract protected function massAction(DataModel $testimonial);

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection as $testimonial) {
                $this->massAction($testimonial);
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
