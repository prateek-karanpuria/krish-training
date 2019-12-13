<?php
namespace Ktpl\CustomApis\Api;

interface CrossSellInterface
{
    /**
     * Returns greeting message to user
     *
     * @param int $quote Users name.
     * @return \KtplCrossSellInterface\CustomApi\Api\CrossSellInterface[]
     */
    public function getCrossByQuote($quote);

}
