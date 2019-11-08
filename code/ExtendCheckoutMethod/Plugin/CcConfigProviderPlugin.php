<?php


namespace Krish\ExtendCheckoutMethod\Plugin;

 
class CcConfigProviderPlugin
{
    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    private $assetRepo;
 
    /**
     * CcConfigProviderPlugin constructor.
     *
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     */
    public function __construct(
        \Magento\Framework\View\Asset\Repository $assetRepo
    )
    {
        $this->assetRepo = $assetRepo;
    }
 
    /**
     * @param \Magento\Payment\Model\CcConfigProvider $subject
     * @param $result
     * @return mixed
     */
    public function afterGetIcons(\Magento\Payment\Model\CcConfigProvider $subject, $result)
    {
        if (isset($result['DI'])) {

            $result['DI']['url'] = $this->assetRepo->getUrl('Krish_ExtendCheckoutMethod::images/norton_secure_seal.png');

            $result['JCB']['url'] = $this->assetRepo->getUrl('Krish_ExtendCheckoutMethod::images/VeriSign__Inc_.png');

            $result['DI']['JCB']['width'] = 46;
            $result['DI']['JCB']['height'] = 30;
        }
        return $result;
    }
}