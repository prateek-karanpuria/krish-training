<?php

namespace SussexDev\Sample\Model;

use SussexDev\Sample\Api\SampleRepositoryInterface;
use SussexDev\Sample\Model\ResourceModel\Data\CollectionFactory;

class SampleRepository implements SampleRepositoryInterface
{
    protected $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getList()
    {
        return $this->collectionFactory->create()->getItems();
    }
}
