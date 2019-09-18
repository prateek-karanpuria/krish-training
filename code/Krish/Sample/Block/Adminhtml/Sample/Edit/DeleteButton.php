<?php
/**
 * File: BackButton.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Block\Adminhtml\Sample\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

//Button for deleting a sample from sample edit page.

/**
 * Class DeleteButton
 * @package Krish\Sample\Block\Adminhtml\Sample\Edit
 */
class DeleteButton extends AbstractButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Delete Sample'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this sample?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getId()]);
    }
}
