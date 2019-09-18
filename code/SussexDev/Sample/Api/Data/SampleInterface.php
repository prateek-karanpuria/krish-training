<?php

namespace SussexDev\Sample\Api\Data;

interface SampleInterface
{
    /**
     * @return string
     */
    public function getDataTitle();

    /**
     * @return string | null
     */
    public function getDataDescription();
}
