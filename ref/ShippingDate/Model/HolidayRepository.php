<?php


namespace Ktpl\ShippingDate\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Ktpl\ShippingDate\Api\Data\HolidaySearchResultsInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Ktpl\ShippingDate\Model\ResourceModel\Holiday as ResourceHoliday;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Ktpl\ShippingDate\Api\Data\HolidayInterfaceFactory;
use Ktpl\ShippingDate\Api\HolidayRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Ktpl\ShippingDate\Model\ResourceModel\Holiday\CollectionFactory as HolidayCollectionFactory;

class HolidayRepository implements HolidayRepositoryInterface
{

    private $collectionProcessor;

    private $storeManager;

    protected $holidayCollectionFactory;

    protected $dataObjectProcessor;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $dataHolidayFactory;

    protected $dataObjectHelper;

    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $holidayFactory;


    /**
     * @param ResourceHoliday $resource
     * @param HolidayFactory $holidayFactory
     * @param HolidayInterfaceFactory $dataHolidayFactory
     * @param HolidayCollectionFactory $holidayCollectionFactory
     * @param HolidaySearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceHoliday $resource,
        HolidayFactory $holidayFactory,
        HolidayInterfaceFactory $dataHolidayFactory,
        HolidayCollectionFactory $holidayCollectionFactory,
        HolidaySearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->holidayFactory = $holidayFactory;
        $this->holidayCollectionFactory = $holidayCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataHolidayFactory = $dataHolidayFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Ktpl\ShippingDate\Api\Data\HolidayInterface $holiday
    ) {
        /* if (empty($holiday->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $holiday->setStoreId($storeId);
        } */
        
        $holidayData = $this->extensibleDataObjectConverter->toNestedArray(
            $holiday,
            [],
            \Ktpl\ShippingDate\Api\Data\HolidayInterface::class
        );
        
        $holidayModel = $this->holidayFactory->create()->setData($holidayData);
        
        try {
            $this->resource->save($holidayModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the holiday: %1',
                $exception->getMessage()
            ));
        }
        return $holidayModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($holidayId)
    {
        $holiday = $this->holidayFactory->create();
        $this->resource->load($holiday, $holidayId);
        if (!$holiday->getId()) {
            throw new NoSuchEntityException(__('Holiday with id "%1" does not exist.', $holidayId));
        }
        return $holiday->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->holidayCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Ktpl\ShippingDate\Api\Data\HolidayInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Ktpl\ShippingDate\Api\Data\HolidayInterface $holiday
    ) {
        try {
            $holidayModel = $this->holidayFactory->create();
            $this->resource->load($holidayModel, $holiday->getHolidayId());
            $this->resource->delete($holidayModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Holiday: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($holidayId)
    {
        return $this->delete($this->getById($holidayId));
    }
}
