<?php

namespace Training\Testimonial\Block\Adminhtml\Testimonial\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * SaveAndContinue class
 * @package Training\Testimonial\Block\Adminhtml\Testimonial\Edit\Buttons\SaveAndContinue
 */
class SaveAndContinue extends Generic implements ButtonProviderInterface
{

    /**
     * Get button attributes
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'          => __('Save and Continue Edit'),
            'class'          => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order'     => 80,
        ];
    }
}
