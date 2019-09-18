<?php
/**
 * File: CartCounterSection.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\CustomerData;

use Magento\Checkout\Model\Session;
use Magento\Customer\CustomerData\SectionSourceInterface;

/**
 * Class CartCounterSection
 * @package Krish\Sample\CustomerData
 */
class CartCounterSection implements SectionSourceInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * CartCounterSection constructor.
     * @param Session $session
     */
    public function __construct(
        Session $session
    ) {
        $this->session = $session;
    }

    /**
     * @return array
     */
    public function getSectionData()
    {
        $counter = 0;

        foreach ($this->session->getQuote()->getAllVisibleItems() as $item) {
            $counter += $item->getQty();
        }
        return [
            'count' => $counter
        ];
    }
}
