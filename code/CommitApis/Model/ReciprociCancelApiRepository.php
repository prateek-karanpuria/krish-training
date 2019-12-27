<?php


namespace Reciproci\CommitApis\Model;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Reciproci\CommitApis\Api\ReciprociCancelApiRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Reciproci\CommitApis\Model\ResourceModel\ReciprociCancelApi as ResourceReciprociCancelApi;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Reciproci\CommitApis\Api\Data\ReciprociCancelApiSearchResultsInterfaceFactory;
use Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Reciproci\CommitApis\Model\ResourceModel\ReciprociCancelApi\CollectionFactory as ReciprociCancelApiCollectionFactory;

class ReciprociCancelApiRepository implements ReciprociCancelApiRepositoryInterface
{

    protected $dataObjectHelper;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $dataReciprociCancelApiFactory;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $reciprociCancelApiFactory;

    protected $reciprociCancelApiCollectionFactory;


    /**
     * @param ResourceReciprociCancelApi $resource
     * @param ReciprociCancelApiFactory $reciprociCancelApiFactory
     * @param ReciprociCancelApiInterfaceFactory $dataReciprociCancelApiFactory
     * @param ReciprociCancelApiCollectionFactory $reciprociCancelApiCollectionFactory
     * @param ReciprociCancelApiSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceReciprociCancelApi $resource,
        ReciprociCancelApiFactory $reciprociCancelApiFactory,
        ReciprociCancelApiInterfaceFactory $dataReciprociCancelApiFactory,
        ReciprociCancelApiCollectionFactory $reciprociCancelApiCollectionFactory,
        ReciprociCancelApiSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->reciprociCancelApiFactory = $reciprociCancelApiFactory;
        $this->reciprociCancelApiCollectionFactory = $reciprociCancelApiCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataReciprociCancelApiFactory = $dataReciprociCancelApiFactory;
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
        \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface $reciprociCancelApi
    ) {
        /* if (empty($reciprociCancelApi->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $reciprociCancelApi->setStoreId($storeId);
        } */
        
        $reciprociCancelApiData = $this->extensibleDataObjectConverter->toNestedArray(
            $reciprociCancelApi,
            [],
            \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface::class
        );
        
        $reciprociCancelApiModel = $this->reciprociCancelApiFactory->create()->setData($reciprociCancelApiData);
        
        try {
            $this->resource->save($reciprociCancelApiModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the reciprociCancelApi: %1',
                $exception->getMessage()
            ));
        }
        return $reciprociCancelApiModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($reciprociCancelApiId)
    {
        $reciprociCancelApi = $this->reciprociCancelApiFactory->create();
        $this->resource->load($reciprociCancelApi, $reciprociCancelApiId);
        if (!$reciprociCancelApi->getId()) {
            throw new NoSuchEntityException(__('reciproci_cancel_api with id "%1" does not exist.', $reciprociCancelApiId));
        }
        return $reciprociCancelApi->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->reciprociCancelApiCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface::class
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
        \Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface $reciprociCancelApi
    ) {
        try {
            $reciprociCancelApiModel = $this->reciprociCancelApiFactory->create();
            $this->resource->load($reciprociCancelApiModel, $reciprociCancelApi->getReciprociCancelApiId());
            $this->resource->delete($reciprociCancelApiModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the reciproci_cancel_api: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($reciprociCancelApiId)
    {
        return $this->delete($this->get($reciprociCancelApiId));
    }
}
