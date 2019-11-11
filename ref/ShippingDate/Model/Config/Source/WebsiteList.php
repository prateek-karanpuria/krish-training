<?php


namespace Ktpl\ShippingDate\Model\Config\Source;

class WebsiteList implements \Magento\Framework\Option\ArrayInterface
{
    protected $_storeManager;
    protected $_websiteFullNames;
 
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {        
        $this->_storeManager = $storeManager;
    }


    public function toOptionArray() {
        $websites = $this->_storeManager->getWebsites();
        
        $websitesList = array();
        foreach ($websites as $key => $website) {
            $id = $website->getId();
            $websitesList[$id]["value"] = $id;
            $websitesList[$id]["label"] = $website->getName();
        }
        return $websitesList;
    }

    public function toArray()
    {
        return ['' => __('')];
    }

}
