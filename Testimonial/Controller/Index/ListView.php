<?php

namespace Training\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Result\PageFactory;
use Training\Testimonial\Helper\Data;

/**
 * Class ListView
 * @package Training\Testimonial\Controller\Index
 */
class ListView extends Action
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
     * ListView constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        UrlInterface $urlInterface,
        Data $helperData,
        PageFactory $pageFactory
    ) {
        $this->_helperData   = $helperData;
        $this->_urlInterface = $urlInterface;
        $this->_pageFactory  = $pageFactory;

        return parent::__construct($context);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        if ($this->_helperData->getGeneralConfig('module_enable')) {
            return $this->_pageFactory->create();
        } else {
            $this->_redirect($this->_urlInterface->getBaseUrl());
        }
    }
}
