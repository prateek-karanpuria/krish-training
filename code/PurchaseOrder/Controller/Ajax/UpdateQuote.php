<?php

namespace Ktpl\PurchaseOrder\Controller\Ajax;

use \Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\CookieManagerInterface;


class UpdateQuote extends \Magento\Framework\App\Action\Action
{

    const COOKIE_NAME = 'ponumber';

    protected $jsonHelper;
    protected $checkoutSession;
    protected $customerSession;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        CheckoutSession $checkoutSession,
        CookieManagerInterface $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory,
        SessionManagerInterface $sessionManager
    ) {
        $this->jsonHelper = $jsonHelper;
        $this->checkoutSession = $checkoutSession;
         $this->cookieManager = $cookieManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->sessionManager = $sessionManager;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $postData = (array) $this->getRequest()->getPost();
            $quote = $this->checkoutSession->getQuote();
            $quote->setDcPoNumber(trim($postData["ponumber"]));
            $quote->save();
             $this->setCookie(trim($postData["ponumber"]));
            return $this->jsonResponse("PO Number Updated.");
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            return $this->jsonResponse($e->getMessage());
        } catch (\Exception $e) {
            return $this->jsonResponse($e->getMessage());
        }
    }

    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->jsonEncode($response)
        );
    }

    /**
     * @param string $value
     * @param int $duration
     * @return void
     */
    public function setCookie($value, $duration = 86400)
    {
        $metadata = $this->cookieMetadataFactory
            ->createPublicCookieMetadata()
            //->setDuration($duration)
            ->setPath($this->sessionManager->getCookiePath())
            ->setDomain($this->sessionManager->getCookieDomain());

        $this->cookieManager->setPublicCookie(
            self::COOKIE_NAME,
            $value,
            $metadata
        );
    }
}
