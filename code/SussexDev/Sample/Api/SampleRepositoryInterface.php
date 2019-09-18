<?php

namespace SussexDev\Sample\Api;

interface SampleRepositoryInterface
{
    /**
     * @return \SussexDev\Sample\Api\Data\SampleInterface[]
     */
    public function getList();
}
