<?php
/**
 * File: SampleFixture.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

/** @var \Krish\Sample\Api\Data\SampleInterface $sample */
$sample = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->create('Krish\Sample\Api\Data\SampleInterface');

/** @var \Krish\Sample\Api\Data\SampleRepositoryInterface $sampleRepository */
$sampleRepository = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()
    ->create('Krish\Sample\Api\Data\SampleRepositoryInterface');

$sample->setTitle('Sample title for sample model');
$sample->setDescription('Sample description for sample model');

$sampleRepository->save($sample);
