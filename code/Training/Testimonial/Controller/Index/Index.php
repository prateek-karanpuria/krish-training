<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
#use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        //return $this->resultFactory->create(ResultFactory::TYPE_RAW)->setContents("In index page");
        //return $this->resultFactory->create(ResultFactory::TYPE_PAGE)->setContents("In index page");
        return $this->pageFactory->create();
    }
}
