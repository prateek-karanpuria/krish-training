<?php
/**
 * File: AbstractController.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Controller\Adminhtml\Sample;

use Magento\Backend\App\Action;

//Abstract controller for all sample-related controllers. Ensures all controllers
//are behind the ACL resource defined in this class.

/**
 * Class AbstractController
 * @package Krish\Sample\Controller\Adminhtml\Sample
 */
abstract class AbstractController extends Action
{
    const ADMIN_RESOURCE = 'Krish_Sample::sample_manage';
}
