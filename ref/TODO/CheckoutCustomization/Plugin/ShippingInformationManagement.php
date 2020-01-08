<?php

namespace Ktpl\CheckoutCustomization\Plugin;

/**
 * ShippingInformationManagement class
 * @package Ktpl\CheckoutCustomization\Plugin
 */
class ShippingInformationManagement
{
    protected $quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    )
    {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info("In");

// $logger->info(get_class_methods($addressInformation->getShippingAddress()));
// $logger->info($addressInformation->getShippingAddress()->getData());
// $logger->info($addressInformation->getAddressOf());
//      $extAttributes = $addressInformation->getExtensionAttributes();
        //$addressOf = $extAttributes->getAddressOf();
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setAddresssOf("Office");
    }
}
