<?php

namespace Training\Testimonial\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * ApprovalOptions class
 * @package Training\Testimonial\Ui\Component\Listing\Column\ApprovalOptions
 */
class ApprovalOptions implements OptionSourceInterface
{

    public function toOptionArray()
    {
        $options = [
            ['label' => 'Pending', 'value' => 0],
            ['label' => 'Approved', 'value' => 1],
            ['label' => 'Disapproved', 'value' => 2],
        ];
        return $options;
    }
}
