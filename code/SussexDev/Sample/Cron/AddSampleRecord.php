<?php

namespace SussexDev\Sample\Cron;

use SussexDev\Sample\Model\DataFactory;

class AddSampleRecord
{
    protected $dataFactory;

    public function __construct(
        DataFactory $dataFactory
    )
    {
        $this->dataFactory = $dataFactory;
    }

    public function execute()
    {
        $this->dataFactory->create()
            ->setRowData('data_title', 'Schedule cron record')
            ->setDataDescription('Item added via cron, executed at: '.time())
            ->save();
    }
}
