<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Timeslot\Model\Renderer;

class Status extends \Magento\Ui\Component\Listing\Columns\Column 
{

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ){
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) 
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as & $item) {
                if($item['module_status'] == 0)
                {
                    $item['module_status'] = "Disable";
                }
                if($item['module_status'] == 1)
                {
                    $item['module_status'] = "Enable";
                }



            }
        }

        return $dataSource;
    }
}