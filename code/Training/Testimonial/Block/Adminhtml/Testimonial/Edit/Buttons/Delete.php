<?php

namespace Training\Testimonial\Block\Adminhtml\Testimonial\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Delete class
 * @package Training\Testimonial\Block\Adminhtml\Testimonial\Edit\Buttons\Delete
 */
class Delete extends Generic implements ButtonProviderInterface
{
    /**
     * Get button attributeså
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getDataId()) {
            $data = [
                'label'      => __('Delete Testimonial'),
                'class'      => 'delete',
                'on_click'   => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * Get delete URL
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('testimonial/index/delete', ['id' => $this->getDataId()]);
    }
}
