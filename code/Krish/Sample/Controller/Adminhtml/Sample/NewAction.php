<?php
/**
 * File: NewAction.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

//Simple controller for showing a new sample form.

/**
 * Class NewAction
 * @package Krish\Sample\Controller\Adminhtml\Sample
 */
class NewAction extends AbstractController
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
