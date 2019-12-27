<?php


namespace Reciproci\CommitApis\Model;

use Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterface;
use Magento\Framework\Api\DataObjectHelper;
use Reciproci\CommitApis\Api\Data\ReciprociCancelApiInterfaceFactory;

class ReciprociCancelApi extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'reciproci_commitapis_reciproci_cancel_api';
    protected $reciproci_cancel_apiDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param ReciprociCancelApiInterfaceFactory $reciproci_cancel_apiDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Reciproci\CommitApis\Model\ResourceModel\ReciprociCancelApi $resource
     * @param \Reciproci\CommitApis\Model\ResourceModel\ReciprociCancelApi\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ReciprociCancelApiInterfaceFactory $reciproci_cancel_apiDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Reciproci\CommitApis\Model\ResourceModel\ReciprociCancelApi $resource,
        \Reciproci\CommitApis\Model\ResourceModel\ReciprociCancelApi\Collection $resourceCollection,
        array $data = []
    ) {
        $this->reciproci_cancel_apiDataFactory = $reciproci_cancel_apiDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve reciproci_cancel_api model with reciproci_cancel_api data
     * @return ReciprociCancelApiInterface
     */
    public function getDataModel()
    {
        $reciproci_cancel_apiData = $this->getData();
        
        $reciproci_cancel_apiDataObject = $this->reciproci_cancel_apiDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $reciproci_cancel_apiDataObject,
            $reciproci_cancel_apiData,
            ReciprociCancelApiInterface::class
        );
        
        return $reciproci_cancel_apiDataObject;
    }
}
