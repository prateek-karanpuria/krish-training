<?php


namespace Ktpl\Timeslot\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Ktpl\Timeslot\Model\ResourceModel\Timeslot as ResourceTimeslot;
use Magento\Framework\Exception\NoSuchEntityException;
use Ktpl\Timeslot\Api\TimeslotRepositoryInterface;
use Ktpl\Timeslot\Api\Data\TimeslotSearchResultsInterfaceFactory;
use Magento\Framework\Api\SortOrder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Ktpl\Timeslot\Api\Data\TimeslotInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Ktpl\Timeslot\Model\ResourceModel\Timeslot\CollectionFactory as TimeslotCollectionFactory;

class TimeslotRepository implements TimeslotRepositoryInterface
{

    protected $timeslotFactory;

    protected $timeslotCollectionFactory;

    protected $dataTimeslotFactory;

    private $storeManager;
    protected $dataObjectProcessor;

    protected $resource;

    protected $dataObjectHelper;

    protected $searchResultsFactory;


    /**
     * @param ResourceTimeslot $resource
     * @param TimeslotFactory $timeslotFactory
     * @param TimeslotInterfaceFactory $dataTimeslotFactory
     * @param TimeslotCollectionFactory $timeslotCollectionFactory
     * @param TimeslotSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceTimeslot $resource,
        TimeslotFactory $timeslotFactory,
        TimeslotInterfaceFactory $dataTimeslotFactory,
        TimeslotCollectionFactory $timeslotCollectionFactory,
        TimeslotSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->timeslotFactory = $timeslotFactory;
        $this->timeslotCollectionFactory = $timeslotCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTimeslotFactory = $dataTimeslotFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Ktpl\Timeslot\Api\Data\TimeslotInterface $timeslot
    ) {
        /* if (empty($timeslot->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $timeslot->setStoreId($storeId);
        } */
        try {
            $this->resource->save($timeslot);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the timeslot: %1',
                $exception->getMessage()
            ));
        }
        return $timeslot;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($timeslotId)
    {
        $timeslot = $this->timeslotFactory->create();
        $this->resource->load($timeslot, $timeslotId);
        if (!$timeslot->getId()) {
            throw new NoSuchEntityException(__('Timeslot with id "%1" does not exist.', $timeslotId));
        }
        return $timeslot;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->timeslotCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            $fields = [];
            $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $fields[] = $filter->getField();
                $condition = $filter->getConditionType() ?: 'eq';
                $conditions[] = [$condition => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Ktpl\Timeslot\Api\Data\TimeslotInterface $timeslot
    ) {
        try {
            $this->resource->delete($timeslot);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Timeslot: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($timeslotId)
    {
        return $this->delete($this->getById($timeslotId));
    }
}
