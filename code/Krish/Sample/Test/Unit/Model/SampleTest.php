<?php
/**
 * File: SampleTest.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Test\Unit\Model;

use Krish\Sample\Api\Data\SampleInterface;
use Krish\Sample\Model\SampleFactory;
use Krish\Sample\Model\ResourceModel\Sample as SampleResource;
use Krish\Sample\Model\Sample;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Api\ExtensionAttributesFactory;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

/**
 * Class SampleTest
 * @package Krish\Sample\Test\Unit\Model
 */
class SampleTest extends TestCase
{
    private $sampleFactory;

    private $context;

    private $registry;

    private $abstractResource;

    private $abstractDB;

    private $sample;

    private $objectManager;

    protected function setUp()
    {
        $this->sampleFactory = $this->getMockBuilder(SampleFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->registry = $this->getMockBuilder(Registry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractResource = $this->getMockBuilder(SampleResource::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractDB = $this->getMockBuilder(AbstractDb::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->objectManager = new ObjectManager($this);
        $this->sample = $this->objectManager->getObject(
            Sample::class,
            [
                'sampleDataFactory' => $this->sampleFactory,
                'context' => $this->context,
                'registry' => $this->registry,
                'resource' => $this->abstractResource,
                'resourceCollection' => $this->abstractDB,
                'data' => []
            ]
        );
    }

    /**
     * @test
     */
    public function testGetIdentities()
    {
        $id = 1;
        $this->sample->setId($id);

        $expectedIdentity = 'ktpl_sample_' . $id;
        $this->assertEquals(
            [$expectedIdentity],
            $this->sample->getIdentities()
        );
    }
}
