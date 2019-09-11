<?php

namespace Training\Testimonial\Model\Config\Source;

/**
 * Class AscDesc
 * @package Training\Testimonial\Model\Config\Source
 */
class AscDesc implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * Options getter
     * @return array
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 0,
                'label' => __('Ascending'),
            ],

            [
                'value' => 1,
                'label' => __('Descending'),
            ],
        ];
    }

    /**
     * Get options in "key-value" format
     * @return array
     */
    public function toArray()
    {
        return [
            __('Ascending'),
            __('Descending'),
        ];
    }
}
