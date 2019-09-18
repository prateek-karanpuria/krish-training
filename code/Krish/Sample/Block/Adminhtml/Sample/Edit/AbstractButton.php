<?php
/**
 * File: AbstractButton.php
 *
 * @author      Vishves Shah <vishves.shah@krishtechnolabs.com>
 * Github:      https://github.com/maciejslawik
 */

namespace Krish\Sample\Block\Adminhtml\Sample\Edit;

use Magento\Framework\Registry;
use Magento\Framework\UrlInterface;

//Abstract for all buttons on sample edit

/**
 * Class AbstractButton
 * @package Krish\Sample\Block\Adminhtml\Sample\Edit
 */
abstract class AbstractButton
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * AbstractButton constructor.
     * @param UrlInterface $urlBuilder
     * @param Registry $registry
     */
    public function __construct(
        UrlInterface $urlBuilder,
        Registry $registry
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->registry = $registry;
    }

    /**
     * @return null
     */
    public function getId()
    {
        $sample = $this->registry->registry('sample');
        return $sample ? $sample->getId() : null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
