<?php

namespace Training\Testimonial\Block\Adminhtml\Testimonial\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Save class
 * @package Training\Testimonial\Block\Adminhtml\Testimonial\Edit\Buttons\Save
 */
class Save extends Generic implements ButtonProviderInterface
{
    /**
     * Get button attributes
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'          => __('Save Testimonial'),
            'class'          => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order'     => 90,
        ];
    }
}
