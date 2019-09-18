<?php
/**
 * File: Save.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Controller\Adminhtml\Product;

use Magento\Catalog\Controller\Adminhtml\Product\Save as MagentoSave;

//A controller class which rewrites the original product save controller.
//Thanks to preference there is no need to worry about URLs, the controller
//is simply called before the original one.

/**
 * Class Save
 * @package Krish\Sample\Controller\Adminhtml\Product
 */
class Save extends MagentoSave
{
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $this->_eventManager->dispatch(
            'ktpl_sample_product_save_controller',
            [
                'passed_argument' => 'from a controller'
            ]
        );

        return parent::execute();
    }
}
