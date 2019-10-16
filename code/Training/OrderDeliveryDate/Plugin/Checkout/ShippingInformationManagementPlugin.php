<?php

/**
 * This before-plugin class is used for modifying saveAddressInformation() function
 * of \Magento\Checkout\Model\ShippingInformationManagement
 */

namespace Training\OrderDeliverydate\Plugin\Checkout;

use Magento\Quote\Model\QuoteRepository;

/**
 * class ShippingInformationManagementPlugin
 * @package Training\OrderDeliverydate\Plugin\Checkout\ShippingInformationManagementPlugin
 */
class ShippingInformationManagementPlugin
{
    protected $quoteRepository;

    /**
     * [__construct description]
     * @param QuoteRepository $quoteRepository [description]
     */
    public function __construct(
        QuoteRepository $quoteRepository
    ) {
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
    ) {
        $extAttributes = $addressInformation->getExtensionAttributes();
        $deliveryDate = $extAttributes->getDeliveryDate();
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setDeliveryDate($deliveryDate);
    }
}
