<?php


namespace Reciproci\CommitApis\Model;

use Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterface;
use Reciproci\CommitApis\Api\Data\ReciprociDeliveryApiInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class ReciprociDeliveryApi extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $reciproci_delivery_apiDataFactory;

    protected $_eventPrefix = 'reciproci_commitapis_reciproci_delivery_api';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ReciprociDeliveryApiInterfaceFactory $reciproci_delivery_apiDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Reciproci\CommitApis\Model\ResourceModel\ReciprociDeliveryApi $resource
     * @param \Reciproci\CommitApis\Model\ResourceModel\ReciprociDeliveryApi\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ReciprociDeliveryApiInterfaceFactory $reciproci_delivery_apiDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Reciproci\CommitApis\Model\ResourceModel\ReciprociDeliveryApi $resource,
        \Reciproci\CommitApis\Model\ResourceModel\ReciprociDeliveryApi\Collection $resourceCollection,
        array $data = []
    ) {
        $this->reciproci_delivery_apiDataFactory = $reciproci_delivery_apiDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve reciproci_delivery_api model with reciproci_delivery_api data
     * @return ReciprociDeliveryApiInterface
     */
    public function getDataModel()
    {
        $reciproci_delivery_apiData = $this->getData();
        
        $reciproci_delivery_apiDataObject = $this->reciproci_delivery_apiDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reciproci_delivery_apiDataObject,
            $reciproci_delivery_apiData,
            ReciprociDeliveryApiInterface::class
        );
        
        return $reciproci_delivery_apiDataObject;
    }
}
