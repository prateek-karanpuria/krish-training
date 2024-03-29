<?php

namespace Training\Testimonial\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Training\Testimonial\Api\TestimonialRepositoryInterface;

abstract class Data extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ACTION_RESOURCE = 'Training_Testimonial::testimonial_list';

    /**
     * Testimonial repository
     *
     * @var TestimonialRepositoryInterface
     */
    protected $testimonialRepository;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Result Forward Factory
     *
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * Data constructor.
     *
     * @param Registry $registry
     * @param DataRepositoryInterface $dataRepository
     * @param PageFactory $resultPageFactory
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     */
    public function __construct(
        Registry $registry,
        TestimonialRepositoryInterface $testimonialRepository,
        PageFactory $resultPageFactory,
        ForwardFactory $resultForwardFactory,
        Context $context
    ) {
        $this->coreRegistry          = $registry;
        $this->testimonialRepository = $testimonialRepository;
        $this->resultPageFactory     = $resultPageFactory;
        $this->resultForwardFactory  = $resultForwardFactory;
        parent::__construct($context);
    }
}
