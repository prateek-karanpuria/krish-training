<?php

/**
 * Helper class to display login status
 */

namespace Training\Testimonial\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * class AdminLoginStatusValue
 * @package Training\Testimonial\Ui\Component\Listing\Column
 */
class AdminLoginStatusValue implements OptionSourceInterface
{

    /**
     * [toOptionArray description]
     * @return Array
     */
    public function toOptionArray()
    {
        $options = [
            ['label' => 'Success', 'value' => 'success'],
            ['label' => 'Failure', 'value' => 'failure'],
        ];
        return $options;
    }
}
