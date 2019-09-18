<?php
/**
 * File: OrderRepository.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Plugin;

use Exception;
use Krish\Sample\Api\Data\SampleInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Krish\Sample\Api\Data\SampleRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;

/**
 * Class OrderRepository
 * @package Krish\Sample\Plugin
 */
class OrderRepository
{
    /**
     * @var SampleRepositoryInterface
     */
    private $sampleRepository;

    /**
     * @var OrderExtensionFactory
     */
    private $extensionFactory;

    /**
     * SaveSampleToOrder constructor.
     * @param SampleRepositoryInterface $sampleRepository
     * @param OrderExtensionFactory $extensionFactory
     */
    public function __construct(
        SampleRepositoryInterface $sampleRepository,
        OrderExtensionFactory $extensionFactory
    ) {
        $this->sampleRepository = $sampleRepository;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $result
     * @return OrderInterface
     */
    public function afterSave(OrderRepositoryInterface $subject, OrderInterface $result)
    {
        if ($result->getExtensionAttributes() && $result->getExtensionAttributes()->getSample()) {
            /** @var SampleInterface $sample */
            $sample = $result->getExtensionAttributes()->getSample();
            $sample->setOrderId((int)$result->getEntityId());
            $this->sampleRepository->save($sample);
        }
        return $result;
    }

    /**
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $result
     * @return OrderInterface
     */
    public function afterGet(OrderRepositoryInterface $subject, OrderInterface $result)
    {
        try {
            $sample = $this->sampleRepository->getByOrderId((int)$result->getEntityId());

            $extensionAtrributes = $result->getExtensionAttributes() ?? $this->extensionFactory->create();
            $extensionAtrributes->setSample($sample);
            $result->setExtensionAttributes($extensionAtrributes);
        } catch (Exception $e) {
        }
        return $result;
    }
}
