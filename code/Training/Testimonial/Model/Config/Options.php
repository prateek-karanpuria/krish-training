<?php

namespace Training\Testimonial\Model\Config;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Options extends AbstractSource
{
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('Gold'), 'value' => 'gold'],
            ['label' => __('Silver'), 'value' => 'silver'],
            ['label' => __('Bronze'), 'value' => 'bronze'],
        ];

        return $this->_options;
    }
}
