<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Training\Testimonial\Helper\Data;

/**
 * Class Add
 * @package Training\Testimonial\Controller\Index
 */
class Add extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var Data
     */
    protected $_helperData;

    /**
     * @var UrlInterface
     */
    protected $_urlInterface;

    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * Add constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param CustomerSession $customerSession
     */
    public function __construct(
        Context $context,
        UrlInterface $urlInterface,
        Data $helperData,
        PageFactory $pageFactory,
        Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
        $this->_helperData      = $helperData;
        $this->_urlInterface    = $urlInterface;
        $this->_pageFactory     = $pageFactory;

        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {

        $loggedInUserId = $this->_customerSession->getId() ?? null;

        if ($this->_helperData->getGeneralConfig('module_enable')) {
            if (!$this->_helperData->getGeneralConfig('allow_guest_testimonials_submission') && !$loggedInUserId) {
                $this->_redirect('testimonial/index/listview');
            }

            return $this->_pageFactory->create();
        } else {
            $this->_redirect($this->_urlInterface->getBaseUrl());
        }
    }
}
