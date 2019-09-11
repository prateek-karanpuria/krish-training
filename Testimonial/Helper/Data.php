<?php

namespace Training\Testimonial\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Config class
 * @package  Training\Testimonial\Controller\Index
 */
class Data extends AbstractHelper
{

    /**
     * @constant(XML_PATH_TESTIMONIAL)
     */
    const XML_PATH_TESTIMONIAL = 'testimonials/';

    /**
     * [getConfigValue description]
     * @param  [type] $field   [description]
     * @param  [type] $storeId [description]
     * @return [type]          [description]
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * [getGeneralConfig description]
     * @param  [type] $code    [description]
     * @param  [type] $storeId [description]
     * @return [type]          [description]
     */
    public function getGeneralConfig($code, $storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_TESTIMONIAL . 'general/' . $code, $storeId);
    }

    /**
     * [checkActiveState description]
     * @return [type] [description]
     */
    public function checkActiveState()
    {
        //$status = $this->objectManager->create('Magento\Framework\Module\Status');
        //$status->setIsEnabled(false, [$moduleName]);
        // exit('in');
        return $this->setConfigValue('module_enable');
    }
}
