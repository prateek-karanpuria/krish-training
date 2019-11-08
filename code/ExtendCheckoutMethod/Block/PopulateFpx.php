<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Krish\ExtendCheckoutMethod\Block;

use Magento\Framework\View\Asset\Repository as AssetRepository;

/**
 * Payment method form base block
 *
 * @api
 * @since 100.0.2
 */
class PopulateFpx 
{

    protected $assetRepository;

     public function __construct(
     AssetRepository $assetRepository
  ){
       $this->assetRepository = $assetRepository;
  }

    /**
     * Retrieve payment method icon
     *
     * @return MethodInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getFpxConfig() {
          $output['fpxLogoImageUrl'] = $this->getViewFileUrl('Vendor_PaymentModule::images/fpx_logo.png');

          return $output;
      }

    /**
     * Sets payment method instance to form
     *
     * @param MethodInterface $method
     * @return $this
     */
   public function getViewFileUrl($fileId, array $params = [])
   {
    
    $params = array_merge(['_secure' => $this->request->isSecure()], $params);
    return $this->assetRepository->getUrlWithParams($fileId, $params);
   
  }

}

    