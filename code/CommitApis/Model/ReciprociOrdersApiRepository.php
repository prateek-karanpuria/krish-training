<?php


namespace Reciproci\CommitApis\Model;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Reciproci\CommitApis\Api\ReciprociOrdersApiRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi as ResourceReciprociOrdersApi;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Reciproci\CommitApis\Api\Data\ReciprociOrdersApiSearchResultsInterfaceFactory;
use Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi\CollectionFactory as ReciprociOrdersApiCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterfaceFactory;

class ReciprociOrdersApiRepository implements ReciprociOrdersApiRepositoryInterface
{

    protected $dataObjectHelper;

    private $storeManager;

    protected $reciprociOrdersApiCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $dataReciprociOrdersApiFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $reciprociOrdersApiFactory;


    /**
     * @param ResourceReciprociOrdersApi $resource
     * @param ReciprociOrdersApiFactory $reciprociOrdersApiFactory
     * @param ReciprociOrdersApiInterfaceFactory $dataReciprociOrdersApiFactory
     * @param ReciprociOrdersApiCollectionFactory $reciprociOrdersApiCollectionFactory
     * @param ReciprociOrdersApiSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceReciprociOrdersApi $resource,
        ReciprociOrdersApiFactory $reciprociOrdersApiFactory,
        ReciprociOrdersApiInterfaceFactory $dataReciprociOrdersApiFactory,
        ReciprociOrdersApiCollectionFactory $reciprociOrdersApiCollectionFactory,
        ReciprociOrdersApiSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->reciprociOrdersApiFactory = $reciprociOrdersApiFactory;
        $this->reciprociOrdersApiCollectionFactory = $reciprociOrdersApiCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReciprociOrdersApiFactory = $dataReciprociOrdersApiFactory;
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
        \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface $reciprociOrdersApi
    ) {
        /* if (empty($reciprociOrdersApi->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $reciprociOrdersApi->setStoreId($storeId);
        } */
        
        $reciprociOrdersApiData = $this->extensibleDataObjectConverter->toNestedArray(
            $reciprociOrdersApi,
            [],
            \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface::class
        );
        
        $reciprociOrdersApiModel = $this->reciprociOrdersApiFactory->create()->setData($reciprociOrdersApiData);
        
        try {
            $this->resource->save($reciprociOrdersApiModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the reciprociOrdersApi: %1',
                $exception->getMessage()
            ));
        }
        return $reciprociOrdersApiModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($reciprociOrdersApiId)
    {
        $reciprociOrdersApi = $this->reciprociOrdersApiFactory->create();
        $this->resource->load($reciprociOrdersApi, $reciprociOrdersApiId);
        if (!$reciprociOrdersApi->getId()) {
            throw new NoSuchEntityException(__('reciproci_orders_api with id "%1" does not exist.', $reciprociOrdersApiId));
        }
        return $reciprociOrdersApi->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->reciprociOrdersApiCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface::class
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
        \Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface $reciprociOrdersApi
    ) {
        try {
            $reciprociOrdersApiModel = $this->reciprociOrdersApiFactory->create();
            $this->resource->load($reciprociOrdersApiModel, $reciprociOrdersApi->getReciprociOrdersApiId());
            $this->resource->delete($reciprociOrdersApiModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the reciproci_orders_api: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($reciprociOrdersApiId)
    {
        return $this->delete($this->get($reciprociOrdersApiId));
    }
}
