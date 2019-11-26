<?php

/**
 * This file is referenced from \Magento\OfflineShipping\Model\Carrier\Flatrate
 */

namespace Ktpl\MultiFlatRates\Model\Carrier;

use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

/**
 * AbstractCarrier class
 * @package Ktpl\MultiFlatRates\Model\Carrier 
 */
class AbstractCarrier extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements CarrierInterface
{
    /**
     * @var string
     */
    protected $_code = 'flatrate';

    /**
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * @var \Magento\Shipping\Model\Rate\ResultFactory
     */
    protected $_rateResultFactory;

    /**
     * @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
     */
    protected $_rateMethodFactory;

    /**
     * @var ItemPriceCalculator
     */
    protected $itemPriceCalculator;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        \Magento\OfflineShipping\Model\Carrier\Flatrate\ItemPriceCalculator $itemPriceCalculator,
        array $data = []
    )
    {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        $this->itemPriceCalculator = $itemPriceCalculator;

        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigFlag('active')) return false;

        /**
         * Combined private functions & copied code of:
         *   getFreeBoxesCount(RateRequest $request), getFreeBoxesCountFromChildren($item)
         */
          
        /**
         * @var integer
         */
        $freeBoxes = 0;

        if ($request->getAllItems())
        {
            foreach ($request->getAllItems() as $item)
            {
                if ($item->getProduct()->isVirtual() || $item->getParentItem())
                {
                   continue;   
                }

                if ($item->getHasChildren() && $item->isShipSeparately())
                {
                    foreach ($item->getChildren() as $child)
                    {
                        if ($child->getFreeShipping() && !$child->getProduct()->isVirtual())
                        {
                            $freeBoxes += $item->getQty() * $child->getQty();
                        }
                    }
                }
                elseif ($item->getFreeShipping())
                {
                    $freeBoxes += $item->getQty();
                }
            }
        }

        $this->setFreeBoxes($freeBoxes);

        /**
         * @var Result $result
         */
        $result = $this->_rateResultFactory->create();

        $shippingPrice = $this->getShippingPrice($request, $freeBoxes);


        /**
         * Copied private function getShippingPrice(RateRequest $request, $freeBoxes) code
         */

        $shippingPrice = false;
        $configPrice = $this->getConfigData('price');

        if ($this->getConfigData('type') === 'O')
        {
            /**
             * Per order
             */
            $shippingPrice = $this->itemPriceCalculator->getShippingPricePerOrder($request, $configPrice, $freeBoxes);

        }
        elseif ($this->getConfigData('type') === 'I')
        {
            /**
             * Per Item ('package' in terms of core magento)
             */
            $shippingPrice = $this->itemPriceCalculator->getShippingPricePerItem($request, $configPrice, $freeBoxes);
        }

        $shippingPrice = $this->getFinalPriceWithHandlingFee($shippingPrice);

        if ($shippingPrice !== false && $request->getPackageQty() == $freeBoxes)
        {
            $shippingPrice = '0.00';
        }

        if ($shippingPrice !== false)
        {
            /**
             * Copied private function createResultMethod($shippingPrice) code
             * 
             * @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method
             */
            $method = $this->_rateMethodFactory->create();

            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('title'));

            $method->setMethod($this->_code);
            $method->setMethodTitle($this->getConfigData('name'));

            $method->setPrice($shippingPrice);
            $method->setCost($shippingPrice);

            $result->append($method);
        }

        return $result;
    }

    public function getAllowedMethods()
    {
        return [$this->_code => $this->getConfigData('name')];
    }  
}
