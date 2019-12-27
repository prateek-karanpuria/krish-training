<?php


namespace Reciproci\CommitApis\Model;

use Magento\Framework\Api\DataObjectHelper;
use Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterface;
use Reciproci\CommitApis\Api\Data\ReciprociOrdersApiInterfaceFactory;

class ReciprociOrdersApi extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'reciproci_commitapis_reciproci_orders_api';
    protected $reciproci_orders_apiDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ReciprociOrdersApiInterfaceFactory $reciproci_orders_apiDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi $resource
     * @param \Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ReciprociOrdersApiInterfaceFactory $reciproci_orders_apiDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi $resource,
        \Reciproci\CommitApis\Model\ResourceModel\ReciprociOrdersApi\Collection $resourceCollection,
        array $data = []
    ) {
        $this->reciproci_orders_apiDataFactory = $reciproci_orders_apiDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve reciproci_orders_api model with reciproci_orders_api data
     * @return ReciprociOrdersApiInterface
     */
    public function getDataModel()
    {
        $reciproci_orders_apiData = $this->getData();
        
        $reciproci_orders_apiDataObject = $this->reciproci_orders_apiDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reciproci_orders_apiDataObject,
            $reciproci_orders_apiData,
            ReciprociOrdersApiInterface::class
        );
        
        return $reciproci_orders_apiDataObject;
    }
}
