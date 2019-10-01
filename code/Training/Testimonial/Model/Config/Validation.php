<?php

namespace Training\Testimonial\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;

class Validation extends AbstractBackend
{
    public function validate($object)
    {
        if ($object->getData($this->getAttribute()->getAttributeCode()) < 10) {
            throw new LocalizedException(__('Value must not be less than 10'));
        }
        return parent::validate($object);
    }
}
