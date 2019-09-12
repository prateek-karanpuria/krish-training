<?php

namespace Training\Testimonial\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Training\Testimonial\Api\Data\TestimonialInterface;
use Training\Testimonial\Api\Data\TestimonialInterfaceFactory;
use Training\Testimonial\Api\Data\TestimonialSearchResultsInterfaceFactory;
use Training\Testimonial\Api\TestimonialRepositoryInterface;
use Training\Testimonial\Model\ResourceModel\Testimonial as ResourceData;
use Training\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory as TestimonialCollectionFactory;

/**
 * TestimonialRepository class
 * @package Training\Testimonial\Model
 */
class TestimonialRepository implements TestimonialRepositoryInterface
{
    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @var ResourceData
     */
    protected $resource;

    /**
     * @var TestimonialCollectionFactory
     */
    protected $testimonialCollectionFactory;

    /**
     * @var TestimonialSearchResultsInterfaceFactory
     */
    protected $testimonialSearchResultsFactory;

    /**
     * @var TestimonialInterfaceFactory
     */
    protected $testimonialInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    public function __construct(
        ResourceData $resource,
        TestimonialCollectionFactory $testimonialCollectionFactory,
        TestimonialSearchResultsInterfaceFactory $testimonialSearchResultsInterfaceFactory,
        TestimonialInterfaceFactory $testimonialInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource                        = $resource;
        $this->testimonialCollectionFactory    = $testimonialCollectionFactory;
        $this->testimonialSearchResultsFactory = $testimonialSearchResultsInterfaceFactory;
        $this->testimonialInterfaceFactory     = $testimonialInterfaceFactory;
        $this->dataObjectHelper                = $dataObjectHelper;
    }

    /**
     * @param TestimonialInterface $data
     * @return TestimonialInterface
     * @throws CouldNotSaveException
     */
    public function save(TestimonialInterface $testimonial)
    {
        try {
            /**
             * @var TestimonialInterface|\Magento\Framework\Model\AbstractModel $testimonial
             */
            $this->resource->save($testimonial);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the data: %1',
                $exception->getMessage()
            ));
        }
        return $testimonial;
    }

    /**
     * Get data record
     *
     * @param $testimonialId
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function getById($testimonialId)
    {
        if (!isset($this->instances[$testimonialId])) {
            /**
             * @var \Training\Testimonial\Api\Data\TestimonialInterface|\Magento\Framework\Model\AbstractModel $data
             */
            $data = $this->testimonialInterfaceFactory->create();

            $this->resource->load($data, $testimonialId);

            if (!$data->getId()) {
                throw new NoSuchEntityException(__('Requested data doesn\'t exist'));
            }

            $this->instances[$testimonialId] = $data;
        }
        return $this->instances[$testimonialId];
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Training\Testimonial\Api\Data\DataSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /**
         *  @var \Training\Testimonial\Api\Data\TestimonialSearchResultsInterface $testimonialSearchResultsFactory
         */
        $searchResults = $this->testimonialSearchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /**
         *  @var \Training\Testimonial\Model\ResourceModel\Testimonial\Collection $collection
         */
        $collection = $this->testimonialCollectionFactory->create();

        /**
         *  Add filters from root filter group to the collection
         *  @var FilterGroup $group
         */
        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        $sortOrders = $searchCriteria->getSortOrders();

        /**
         * @var SortOrder $sortOrder
         */
        if ($sortOrders) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $field = $sortOrder->getField();
                $collection->addOrder(
                    $field,
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        } else {
            $field = 'id';
            $collection->addOrder($field, 'ASC');
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $data = [];
        foreach ($collection as $datum) {
            $dataDataObject = $this->testimonialInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray($dataDataObject, $datum->getData(), TestimonialInterface::class);
            $data[] = $dataDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($data);
    }

    /**
     * @param TestimonialInterface $data
     * @return bool
     * @throws CouldNotSaveException
     * @throws StateException
     */
    public function delete(TestimonialInterface $testimonial)
    {
        /**
         * @var \Training\Testimonial\Api\Data\TestimonialInterface|\Magento\Framework\Model\AbstractModel $testimonial
         */
        $id = $testimonial->getId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($testimonial);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove data %1', $id)
            );
        }
        unset($this->instances[$id]);
        return true;
    }

    /**
     * @param $testimonialId
     * @return bool
     */
    public function deleteById($testimonialId)
    {
        $data = $this->getById($testimonialId);
        return $this->delete($data);
    }
}
