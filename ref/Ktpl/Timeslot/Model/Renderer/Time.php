<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Timeslot\Model\Renderer;

class Time extends \Magento\Ui\Component\Listing\Columns\Column 
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
                $time = array("0:00" => "12:00 AM",
                    "0:30" => "12:30 AM",
                    "1:00" => "1:00 AM",
                    "1:30" => "1:30 AM",
                    "2:00" => "2:00 AM",
                    "2:30" => "2:30 AM",
                    "3:00" => "3:00 AM",
                    "3:30" => "3:30 AM",
                    "4:00" => "4:00 AM",
                    "4:30" => "4:30 AM",
                    "5:00" => "5:00 AM",
                    "5:30" => "5:30 AM",
                    "6:00" => "6:00 AM",
                    "6:30" => "6:30 AM",
                    "7:00" => "7:00 AM",
                    "7:30" => "7:30 AM",
                    "8:00" => "8:00 AM",
                    "8:30" => "8:30 AM",
                    "9:00" => "9:00 AM",
                    "9:30" => "9:30 AM",
                    "10:00" => "10:00 AM",
                    "10:30" => "10:30 AM",
                    "11:00" => "11:00 AM",
                    "11:30" => "11:30 AM",
                    "12:00" => "12:00 PM",
                    "12:30" => "12:30 PM",
                    "13:00" => "1:00 PM",
                    "13:30" => "1:30 PM",
                    "14:00" => "2:00 PM",
                    "14:30" => "2:30 PM",
                    "15:00" => "3:00 PM",
                    "15:30" => "3:30 PM",
                    "16:00" => "4:00 PM",
                    "16:30" => "4:30 PM",
                    "17:00" => "5:00 PM",
                    "17:30" => "5:30 PM",
                    "18:00" => "6:00 PM",
                    "18:30" => "6:30 PM",
                    "19:00" => "7:00 PM",
                    "19:30" => "7:30 PM",
                    "20:00" => "8:00 PM",
                    "20:30" => "8:30 PM",
                    "21:00" => "9:00 PM",
                    "21:30" => "9:30 PM",
                    "22:00" => "10:00 PM",
                    "22:30" => "10:30 PM",
                    "23:00" => "11:00 PM",
                    "23:30" => "11:30 PM");
                foreach ($time as $key => $value) 
                {
                    if($item['start_date'] == $key)
                    {
                        $item['start_date'] = $value;
                    }
                    if($item['end_date'] == $key)
                    {
                        $item['end_date'] = $value;
                    }
                }

            }
        }

        return $dataSource;
    }
}