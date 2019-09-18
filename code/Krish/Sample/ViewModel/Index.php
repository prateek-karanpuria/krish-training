<?php
/**
 * File:Index.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\ViewModel;

use Krish\Sample\Api\Data\SampleRepositoryInterface;
use Krish\Sample\Api\Data\SampleSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

//ViewModels are intended to be injected into a block and provide
//data for a template. A ViewModel must implement \Magento\Framework\View\Element\Block\ArgumentInterface

/**
 * Class Index
 * @package Krish\Sample\ViewModel
 */
class Index implements ArgumentInterface
{
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SampleSearchResultInterface|null
     */
    private $samples;

    /**
     * Index constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->sampleRepository = $sampleRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return \Krish\Sample\Api\Data\SampleSearchResultInterface
     */
    public function getSamples(): SampleSearchResultInterface
    {
        if (!$this->samples) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $this->samples = $this->sampleRepository->getList($searchCriteria);
        }
        return $this->samples;
    }
}
