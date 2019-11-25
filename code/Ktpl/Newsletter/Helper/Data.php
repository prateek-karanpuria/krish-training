<?php

namespace Ktpl\Newsletter\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Config class
 * @package  Training\Testimonial\Controller\Index
 */
class Data extends AbstractHelper
{

    /**
     * @constant(XML_PATH)
     */
    const XML_PATH = 'newsletter/general/';

    /**
     * @constant
     */
    const NEWSLETTER_MEDIA_DIRECTORY = 'newsletter/store/image/';

    /**
     * @var Store based media URL
     */
    public $mediaUrl;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\App\Helper\Context $context
    )
    {
        $this->mediaUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        parent::__construct($context);
    }

    /**
     * [getConfigValue description]
     * @param  [type] $field   [description]
     * @param  [type] $storeId [description]
     * @return [type]          [description]
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH.$field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }
}
