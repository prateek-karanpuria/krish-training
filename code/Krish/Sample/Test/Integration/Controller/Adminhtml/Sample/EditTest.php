<?php
/**
 * File: EditTest.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Test\Integration\Controller\Adminhtml\Sample;

use Magento\TestFramework\TestCase\AbstractBackendController;

/**
 * Class EditTest
 * @package Krish\Sample\Test\Integration\Controller\Adminhtml\Sample
 */
class EditTest extends AbstractBackendController
{
    /**
     * @var string
     */
    protected $resource = 'Krish_Sample::sample_manage';
    /**
     * @var string
     */
    protected $uri = 'backend/sample/sample/delete';
}
