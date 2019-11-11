<?php


namespace Ktpl\ShippingDate\Model;

use Ktpl\ShippingDate\Api\Data\HolidayInterfaceFactory;
use Ktpl\ShippingDate\Api\Data\HolidayInterface;
use Magento\Framework\Api\DataObjectHelper;

class Holiday extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'ktpl_shippingdate_holiday';
    protected $holidayDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param HolidayInterfaceFactory $holidayDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Ktpl\ShippingDate\Model\ResourceModel\Holiday $resource
     * @param \Ktpl\ShippingDate\Model\ResourceModel\Holiday\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        HolidayInterfaceFactory $holidayDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Ktpl\ShippingDate\Model\ResourceModel\Holiday $resource,
        \Ktpl\ShippingDate\Model\ResourceModel\Holiday\Collection $resourceCollection,
        array $data = []
    ) {
        $this->holidayDataFactory = $holidayDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve holiday model with holiday data
     * @return HolidayInterface
     */
    public function getDataModel()
    {
        $holidayData = $this->getData();
        
        $holidayDataObject = $this->holidayDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $holidayDataObject,
            $holidayData,
            HolidayInterface::class
        );
        
        return $holidayDataObject;
    }
}
