<?php


namespace Reciproci\CommitApis\Model;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Reciproci\CommitApis\Model\ResourceModel\ReciprociDeliveryApi as ResourceReciprociDeliveryApi;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Reciproci\CommitApis\Model\ResourceModel\ReciprociDeliveryApi\CollectionFactory as ReciprociDeliveryApiCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterfaceFactory;
use Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiSearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Reciproci\CommitApis\Api\ReciprociDeliveryApiRepositoryInterface;

class ReciprociDeliveryApiRepository implements ReciprociDeliveryApiRepositoryInterface
{

    protected $dataObjectHelper;

    private $storeManager;

    protected $dataReciprociDeliveryApiFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $reciprociDeliveryApiFactory;

    protected $reciprociDeliveryApiCollectionFactory;


    /**
     * @param ResourceReciprociDeliveryApi $resource
     * @param ReciprociDeliveryApiFactory $reciprociDeliveryApiFactory
     * @param ReciprociDeliveryApiInterfaceFactory $dataReciprociDeliveryApiFactory
     * @param ReciprociDeliveryApiCollectionFactory $reciprociDeliveryApiCollectionFactory
     * @param ReciprociDeliveryApiSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceReciprociDeliveryApi $resource,
        ReciprociDeliveryApiFactory $reciprociDeliveryApiFactory,
        ReciprociDeliveryApiInterfaceFactory $dataReciprociDeliveryApiFactory,
        ReciprociDeliveryApiCollectionFactory $reciprociDeliveryApiCollectionFactory,
        ReciprociDeliveryApiSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->reciprociDeliveryApiFactory = $reciprociDeliveryApiFactory;
        $this->reciprociDeliveryApiCollectionFactory = $reciprociDeliveryApiCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReciprociDeliveryApiFactory = $dataReciprociDeliveryApiFactory;
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
        \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface $reciprociDeliveryApi
    ) {
        /* if (empty($reciprociDeliveryApi->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $reciprociDeliveryApi->setStoreId($storeId);
        } */
        
        $reciprociDeliveryApiData = $this->extensibleDataObjectConverter->toNestedArray(
            $reciprociDeliveryApi,
            [],
            \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface::class
        );
        
        $reciprociDeliveryApiModel = $this->reciprociDeliveryApiFactory->create()->setData($reciprociDeliveryApiData);
        
        try {
            $this->resource->save($reciprociDeliveryApiModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the reciprociDeliveryApi: %1',
                $exception->getMessage()
            ));
        }
        return $reciprociDeliveryApiModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($reciprociDeliveryApiId)
    {
        $reciprociDeliveryApi = $this->reciprociDeliveryApiFactory->create();
        $this->resource->load($reciprociDeliveryApi, $reciprociDeliveryApiId);
        if (!$reciprociDeliveryApi->getId()) {
            throw new NoSuchEntityException(__('reciproci_delivery_api with id "%1" does not exist.', $reciprociDeliveryApiId));
        }
        return $reciprociDeliveryApi->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->reciprociDeliveryApiCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface::class
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
        \Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface $reciprociDeliveryApi
    ) {
        try {
            $reciprociDeliveryApiModel = $this->reciprociDeliveryApiFactory->create();
            $this->resource->load($reciprociDeliveryApiModel, $reciprociDeliveryApi->getReciprociDeliveryApiId());
            $this->resource->delete($reciprociDeliveryApiModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the reciproci_delivery_api: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($reciprociDeliveryApiId)
    {
        return $this->delete($this->get($reciprociDeliveryApiId));
    }
}
