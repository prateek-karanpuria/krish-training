<?php

namespace Ktpl\CustomApis\Api;

interface ReorderInterface
{
    /**
     * 
     *
     * @api
     * @param int $cartId
     * @param int $orderId
     * @return boolean
     */
    public function createReorder($cartId, $orderId);

}
