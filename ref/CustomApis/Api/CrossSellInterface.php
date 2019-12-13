<?php

namespace Ktpl\CustomApis\Api;
 
interface CrossSellInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param string $name Users name.
     * @return string Greeting message with users name.
     */
    public function name($name);

    /**
     * Returns greeting message to user
     * 
     * @param int $quote Users name.
     * @return \Ktpl\CustomApis\Api\CrossSellInterface[]
     */
    public function getCrossByQuote($quote);
    
    /**
     * Returns greeting message to user
     * 
     * @param int $quoteId Users name.
     * @return \Ktpl\CustomApis\Api\CrossSellInterface[]
     */
    public function getCrossProducts($quoteId);
}
