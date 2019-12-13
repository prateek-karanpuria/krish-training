<?php

namespace Ktpl\Skydailywebshipments\Cron;

/**
 * 1. This file will generate daily shipment CSV for Shopsky Store & keep it in project root folder.
 * 
 * 2. For proper working of this extension make sure you have swatch_color & swatch_size attribute
 *    already created.
 *
 * 3. Set SHOPSKY_STORE_ID whenever you're using this extension
 */

/**
 * ExportDailyWebShipments class
 * @package Ktpl\Skydailywebshipments\Cron
 */
class ExportDailyWebShipments
{
    /**
     * @constant Shopsky store ID
     */
    const SHOPSKY_STORE_ID = 1;

    /**
     * @var SearchCriteriaBuilder
     */
    public $searchCriteriaBuilder;

    /**
     * @var CreditmemoRepositoryInterface
     */
    public $creditmemoRepository;

    /**
     * @var ShipmentRepositoryInterface
     */
    public $shipmentRepository;

    /**
     * @var OrderRepositoryInterface
     */
    public $orderRepository;

    /**
     * @var Product Repository
     */
    public $productAttributeRepository;

    /**
     * @var ProductRepositoryInterface
     */
    public $productRepository;

    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var Swatch color
     */
    public $swatchColorAttribute;

    /**
     * @var Swatch color ID
     */
    public $swatchColorAttributeId;

    /**
     * @var Swatch size
     */
    public $swatchSizeAttribute;

    /**
     * @var Swatch size ID
     */
    public $swatchSizeAttributeId;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Sales\Api\CreditmemoRepositoryInterface $creditmemoRepository,
        \Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\State $state,
        \Magento\Sales\Model\OrderRepository $orderRepository,
        \Magento\Catalog\Model\Product\Attribute\Repository $productAttributeRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
    )
    {
        $this->storeManager = $storeManager;
        $this->dateTime = $dateTime;

        $this->searchCriteriaBuilder = $searchCriteriaBuilder;        
        $this->creditmemoRepository = $creditmemoRepository;
        $this->shipmentRepository = $shipmentRepository;
        $this->orderRepository = $orderRepository;
        $this->productAttributeRepository = $productAttributeRepository;
        $this->productRepository = $productRepository;

        $this->swatchColorAttribute = $this->productAttributeRepository->get('swatch_color');
        $this->swatchColorAttributeId = $this->swatchColorAttribute->getId();

        $this->swatchSizeAttribute = $this->productAttributeRepository->get('swatch_size');
        $this->swatchSizeAttributeId = $this->swatchSizeAttribute->getId();

        $this->startDate = date('Y-m-d H:i:s', strtotime("-1 days"));
        $this->endDate = date('Y-m-d H:i:s');

        /**
         * Export daily web shipment only for Shopsky store
         */
        try
        {
            if ($storeManager->getStore(self::SHOPSKY_STORE_ID)) {
                $storeManager->setCurrentStore(self::SHOPSKY_STORE_ID);
            }
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }

        /**
         * Will need this snippet if running cron file from project root
         */
        // $state->setAreaCode('frontend');
    }

    public function execute()
    {

        $data[] = ['style', 'color', 'size', 'qty', 'datetime'];

        $records = $this->getDataFromShipment();

        $data = array_merge($data, $this->getDataFromShipment());
        $data = array_merge($data, $this->getDataFromCreditMemo());

        /**
         * Write process data in CSV file & place in shipment_csv directory
         */
        $this->exportToCsv($data);
    }

    /**
     * Get Shipment data
     * 
     * @return array for CSV
     */
    public function getDataFromShipment()
    {
        $records = [];

        $searchCriteria = $this->searchCriteriaBuilder
                               ->addFilter('created_at', $this->endDate, 'lteq')
                               ->addFilter('created_at', $this->startDate, 'gteq')->create();

        try
        {
            $shipments = $this->shipmentRepository->getList($searchCriteria)->getItems();
        }
        catch (\Exception $exception)
        {
            $shipments = null;
        }

        if ($shipments)
        {
            foreach ($shipments as $shipment)
            {
                $records = array_merge($records, $this->getOrderInformationByType('shipment', $shipment));
            }
        }

        return $records;
    }

    /**
     * Get Credit Memp data
     * 
     * @return array for CSV
     */
    public function getDataFromCreditMemo()
    {
        $records = [];

        $start = date('Y-m-d H:i:s', strtotime('2017-12-12 00:00:00'));
        $end = date('Y-m-d H:i:s', strtotime('2019-12-12 23:59:59'));

        $searchCriteria = $this->searchCriteriaBuilder
                               ->addFilter('created_at', $this->endDate, 'lteq')
                               ->addFilter('created_at', $this->startDate, 'gteq')->create();
        $creditmemos = $this->creditmemoRepository->getList($searchCriteria)->getItems();

        /**
         * Print Query from repository list
         * print_r($this->creditmemoRepository->getList($searchCriteria)->getSelect()->assemble());
         */

        try
        {
            $creditmemos = $this->creditmemoRepository->getList($searchCriteria)->getItems();
        }
        catch (\Exception $exception)  {
            $creditmemos = null;
        }

        if ($creditmemos)
        {
            foreach ($creditmemos as $creditmemo)
            {
               $records = array_merge($records, $this->getOrderInformationByType('creditmemo', $creditmemo));
            }
        }

        return $records;
    }

    /**
     * Get CSV information based on type shipment / credit memo
     * 
     * @param  string $type
     * @param  object $typeObject
     * @return array for CSV
     */
    public function getOrderInformationByType($type = 'shipment', $typeObject)
    {
        $finalRows = $records = $csvrows = $names = [];

        $created_at = $typeObject->getCreatedAt();
        $orderId = $typeObject->getOrderId();

        $items = $typeObject->getAllItems();
        
        $skus = [];
        if ($items)
        {
            foreach ($items as $item)
            {
                $skus[] = $item->getSku();
            }
        }

        try
        {
            $order = $this->orderRepository->get($orderId);
        }
        catch (\Exception $exception)
        {
            $order = null;
        }

        if ($order)
        {
            $orderItems = $order->getItemsCollection()
                                ->addAttributeToSelect('*')
                                ->addAttributeToSort('parent_item_id', 'asc')
                                ->load();

            if ($orderItems)
            {
                foreach ($orderItems as $sItem)
                {
                    if ($type == 'shipment') {
                        if ($sItem->getQtyShipped() < 1) continue;
                    }
                    else
                    {
                        if ($sItem->getQtyRefunded() < 1) continue;
                    }

                    if ($sItem->getProductType() == 'simple' && in_array($sItem->getSku(), $skus)) 
                    {
        
                        $csvrows[0] = $names[$sItem->getParentItemId()] ?? '';
                        if ($csvrows[0] == '')
                        {
                            $name_parts = explode('-', $sItem->getName());
                            $csvrows[0] = $name_parts[0];
                        }

                        $itemOptions = $sItem->getProductOptions();

                        if ($itemOptions)
                        {
                            $options = $itemOptions['info_buyRequest']['super_attribute'] ?? '';

                            if ($options)
                            {
                                $swatchColorOptionId = $options[$this->swatchColorAttributeId] ?? '';
                                $csvrows[1] = $swatchColorOptionId ? $this->swatchColorAttribute->getSource()->getOptionText($swatchColorOptionId) : '';

                                
                                $swatchSizeOptionId = $options[$this->swatchSizeAttributeId] ?? '';
                                $csvrows[2] = $swatchSizeOptionId ? $this->swatchSizeAttribute->getSource()->getOptionText($swatchSizeOptionId) : '';
                            }


                            $productId = $sItem->getProductId();

                            try
                            {
                                $productItem = $this->productRepository->getById($productId);
                            }
                            catch (\Exception $exception)
                            {
                                $productItem = null;
                            }

                            if ($productItem) {

                                if (empty($csvrows[1]))
                                {
                                    $csvrows[1] = $productItem->getAttributeText('swatch_color') ?? '';
                                }

                               if (empty($csvrows[2]))
                                {
                                    $csvrows[2] = $productItem->getAttributeText('swatch_size') ?? '';
                                }
                            }

                            $csvrows[1] = $csvrows[1] ?? '';
                            $csvrows[2] = $csvrows[2] ?? '';

                            $csvrows[3] = ($type == 'shipment') ? number_format($sItem->getQtyShipped()) : (-1 * number_format($sItem->getQtyRefunded()));

                            $csvrows[4] = date('Ymdhis', $this->dateTime->timestamp($created_at));

                            array_push($records, $csvrows);
                        }
                    }
                    else
                    {
                        $names[$sItem->getId()] = $sItem->getName();
                    }
                }
            }
        }

        /**
         * Process final records
         */
        if ($records)
        {
            foreach ($records as $row) {
                if ($row) {
                    $finalRows[] = $row;
                }
            }
        }

        return $records;
    }

    /**
     * This function will generate CSV & place it in 'shipment_csv' directory
     * kept in project root.
     * 
     * @return void
     */
    public function exportToCsv($data = [])
    {
        /**
         * Create directory on project root if it doesn't exist
         */
        $csvDirectory = BP.DIRECTORY_SEPARATOR.'shipment_csv';
        if (!is_dir($csvDirectory))
        {

            mkdir($csvDirectory, 0777);
        }

        $csvFilename = 'SkyDailyWebShipments_'.date('Y-m-d').'.csv';

        $csvFileHandler = fopen($csvDirectory.DIRECTORY_SEPARATOR.$csvFilename, 'w+');

        if ($csvFileHandler)
        {
            if ($data)
            {
                foreach ($data as $record)
                {
                    @fputcsv($csvFileHandler, array_values($record));
                }
            }

            @fclose($csvFileHandler);
        }
    }

    /**
     * Print result
     * @param  string/array $result
     * @param  boolean $die
     * @return void
     */
    public function print2($result, $die = false) {
        echo '<pre>';
        print_r($result);
        echo '</pre>';

        if ($die) die();
    }
}
