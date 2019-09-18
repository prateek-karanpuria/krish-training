<?php

namespace Training\Testimonial\Model\Data\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * ApprovalStatus class
 * @package Training\Testimonial\Model\Data\Source
 */
class ApprovalStatus implements OptionSourceInterface
{
    /**
     * Get options
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Pending')],
            ['value' => 1, 'label' => __('Approved')],
            ['value' => 2, 'label' => __('Disapproved')],
        ];
    }
}
