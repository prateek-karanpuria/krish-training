<?php
/**
 * File: SampleRepositoryInterface.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Api\Data;

//This is the service contract of the module.
//It provides a consistent API for handling Data Objects.

/**
 * Interface SampleRepositoryInterface
 * @package Krish\Sample\Api\Data
 */
interface SampleRepositoryInterface
{
    /**
     * @param SampleInterface $sample
     * @return void
     */
    public function save(\Krish\Sample\Api\Data\SampleInterface $sample);

    /**
     * @param int $id
     * @return \Krish\Sample\Api\Data\SampleInterface
     */
    public function getById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Krish\Sample\Api\Data\SampleSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Krish\Sample\Api\Data\SampleInterface $sample
     * @return void
     */
    public function delete(\Krish\Sample\Api\Data\SampleInterface $sample);

    /**
     * @param int $id
     * @return \Krish\Sample\Api\Data\SampleSearchResultInterface
     */
    public function deleteById($id);

    /**
     * @param int $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromCheckout(int $cartId, SampleInterface $sample);

    /**
     * @param string $cartId
     * @param SampleInterface $sample
     * @return void
     */
    public function saveSampleFromGuestCheckout(string $cartId, SampleInterface $sample);

    /**
     * @param int $id
     * @return \Krish\Sample\Api\Data\SampleInterface
     */
    public function getByQuoteId($id);

    /**
     * @param int $id
     * @return \Krish\Sample\Api\Data\SampleInterface
     */
    public function getByOrderId($id);
}
