<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\Timeslot\Model\Config\Backend;

/**
 * Source model for element with enable and disable variants.
 * @api
 * @since 100.0.2
 */
class Timedropdown implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Value which equal Enable for Enabledisable dropdown.
     */
    const ENABLE_VALUE = 1;

    /**
     * Value which equal Disable for Enabledisable dropdown.
     */
    const DISABLE_VALUE = 0;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => "0:00", 'label' => __('12:00 AM')],
            ['value' => "0:30", 'label' => __('12:30 AM')],
            ['value' => "1:00", 'label' => __('1:00 AM')],
            ['value' => "1:30", 'label' => __('1:30 AM')],
            ['value' => "2:00", 'label' => __('2:00 AM')],
            ['value' => "2:30", 'label' => __('2:30 AM')],
            ['value' => "3:00", 'label' => __('3:00 AM')],
            ['value' => "3:30", 'label' => __('3:30 AM')],
            ['value' => "4:00", 'label' => __('4:00 AM')],
            ['value' => "4:30", 'label' => __('4:30 AM')],
            ['value' => "5:00", 'label' => __('5:00 AM')],
            ['value' => "5:30", 'label' => __('5:30 AM')],
            ['value' => "6:00", 'label' => __('6:00 AM')],
            ['value' => "6:30", 'label' => __('6:30 AM')],
            ['value' => "7:00", 'label' => __('7:00 AM')],
            ['value' => "7:30", 'label' => __('7:30 AM')],
            ['value' => "8:00", 'label' => __('8:00 AM')],
            ['value' => "8:30", 'label' => __('8:30 AM')],
            ['value' => "9:00", 'label' => __('9:00 AM')],
            ['value' => "9:30", 'label' => __('9:30 AM')],
            ['value' => "10:00", 'label' => __('10:00 AM')],
            ['value' => "10:30", 'label' => __('10:30 AM')],
            ['value' => "11:00", 'label' => __('11:00 AM')],
            ['value' => "11:30", 'label' => __('11:30 AM')],
            ['value' => "12:00", 'label' => __('12:00 PM')],
            ['value' => "12:30", 'label' => __('12:30 PM')],
            ['value' => "13:00", 'label' => __('1:00 PM')],
            ['value' => "13:30", 'label' => __('1:30 PM')],
            ['value' => "14:00", 'label' => __('2:00 PM')],
            ['value' => "14:30", 'label' => __('2:30 PM')],
            ['value' => "15:00", 'label' => __('3:00 PM')],
            ['value' => "15:30", 'label' => __('3:30 PM')],
            ['value' => "16:00", 'label' => __('4:00 PM')],
            ['value' => "16:30", 'label' => __('4:30 PM')],
            ['value' => "17:00", 'label' => __('5:00 PM')],
            ['value' => "17:30", 'label' => __('5:30 PM')],
            ['value' => "18:00", 'label' => __('6:00 PM')],
            ['value' => "18:30", 'label' => __('6:30 PM')],
            ['value' => "19:00", 'label' => __('7:00 PM')],
            ['value' => "19:30", 'label' => __('7:30 PM')],
            ['value' => "20:00", 'label' => __('8:00 PM')],
            ['value' => "20:30", 'label' => __('8:30 PM')],
            ['value' => "21:00", 'label' => __('9:00 PM')],
            ['value' => "21:30", 'label' => __('9:30 PM')],
            ['value' => "22:00", 'label' => __('10:00 PM')],
            ['value' => "22:30", 'label' => __('10:30 PM')],
            ['value' => "23:00", 'label' => __('11:00 PM')],
            ['value' => "23:30", 'label' => __('11:30 PM')],
        ];
    }
}
