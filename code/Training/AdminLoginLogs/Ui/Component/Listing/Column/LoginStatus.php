<?php

/**
 * Helper class to display login status
 */

namespace Training\AdminLoginLogs\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * class LoginStatus
 * @package Training\Testimonial\Ui\Component\Listing\Column
 */
class LoginStatus implements OptionSourceInterface
{
    /**
     * [toOptionArray description]
     * @return Array
     */
    public function toOptionArray()
    {
        $options = [
            ['label' => 'Success', 'value' => '1'],
            ['label' => 'Failure', 'value' => '0'],
        ];
        return $options;
    }
}
