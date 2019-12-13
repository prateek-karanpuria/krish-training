<?php

namespace Ktpl\Signature\Model\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

use Magento\Framework\App\Helper\Context;

/**
 * SalesQuoteSaveBeforeObserver class
 * @package Ktpl\Signature\Model\Observer
 */
class SalesQuoteSaveBeforeObserver extends Context implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(Observer $observer)
    {
        try
        {
            /**
             * @var \Magento\Quote\Model\Quote $quote
             */
            $quote = $observer->getEvent()->getQuote();

            /**
             * #TODO: May need to update
             * 
             * $customer_signature = Mage::app()->getFrontController()->getRequest()->getPost('customer_signature');
             */
            $customerSignature = $quote->getCustomerSignature();

            $configRequireSignatureText = $this->getScopeConfig()->getValue('checkout/signature/require_signature_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

            $configNoRequireSignatureText = $this->getScopeConfig()->getValue('checkout/signature/no_require_signature_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

            if (is_numeric($customerSignature))
            {
               if ($customerSignature)
               {
                   $customerSignature = isset($configRequireSignatureText) && !empty($configRequireSignatureText) ? $configRequireSignatureText : 'Signature Required';
               } 
               else
               {
                   $customerSignature = isset($configNoRequireSignatureText) && !empty($configNoRequireSignatureText) ? $configNoRequireSignatureText : 'No Signature Required';
               }
            }

            if ($customerSignature)
            {
                $quote->setCustomerSignature($customerSignature);
            }
        }
        catch (\Exception $exception)
        {
            $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/debug.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            $logger->err($exception->getMessage());
        }
    }
}
