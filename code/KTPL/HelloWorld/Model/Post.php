<?php

namespace KTPL\HelloWorld\Post;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'ktpl_helloworld_post';

    protected $_cacheTag = 'ktpl_helloworld_post';

    protected $_eventPrefix = 'ktpl_helloworld_post';

    protected function _construct()
    {
        $this->_init('KTPL\HelloWorld\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }

    public function getDefaultValues() {
        $values = [];

        return $values;
    }
}