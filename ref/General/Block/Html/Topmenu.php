<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ktpl\General\Block\Html;

use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\Data\TreeFactory;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

/**
 * Html page top menu block
 *
 * @api
 * @since 100.0.2
 */
class Topmenu extends \Magento\Theme\Block\Html\Topmenu implements IdentityInterface
{
    /**
     * Cache identities
     *
     * @var array
     */
    protected $identities = [];

    /**
     * Top menu data tree
     *
     * @var \Magento\Framework\Data\Tree\Node
     */
    protected $_menu;

    /**
     * @var NodeFactory
     */
    private $nodeFactory;

    /**
     * @var TreeFactory
     */
    private $treeFactory;

    /**
     * @param Template\Context $context
     * @param NodeFactory $nodeFactory
     * @param TreeFactory $treeFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        NodeFactory $nodeFactory,
        TreeFactory $treeFactory,
        array $data = []
    ) {
        parent::__construct($context, $nodeFactory, $treeFactory, $data);
        $this->nodeFactory = $nodeFactory;
        $this->treeFactory = $treeFactory;
    }

    /**
     * Recursively generates top menu html from data that is specified in $menuTree
     *
     * @param \Magento\Framework\Data\Tree\Node $menuTree
     * @param string $childrenWrapClass
     * @param int $limit
     * @param array $colBrakes
     * @return string
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _getHtml(
        \Magento\Framework\Data\Tree\Node $menuTree,
        $childrenWrapClass,
        $limit,
        array $colBrakes = []
    ) {
        $html = '';

        $children = $menuTree->getChildren();
        $parentLevel = $menuTree->getLevel();
        $childLevel = $parentLevel === null ? 0 : $parentLevel + 1;

        $counter = 1;
        $itemPosition = 1;
        $childrenCount = $children->count();

        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';

        /** @var \Magento\Framework\Data\Tree\Node $child */
        foreach ($children as $child) {
            if ($childLevel === 0 && $child->getData('is_parent_active') === false) {
                continue;
            }
            $child->setLevel($childLevel);
            $child->setIsFirst($counter == 1);
            $child->setIsLast($counter == $childrenCount);
            $child->setPositionClass($itemPositionClassPrefix . $counter);

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();

            if ($childLevel == 0 && $outermostClass) {
                $outermostClassCode = ' class="' . $outermostClass . '" ';
                $currentClass = $child->getClass();

                if (empty($currentClass)) {
                    $child->setClass($outermostClass);
                } else {
                    $child->setClass($currentClass . ' ' . $outermostClass);
                }
            }



            if (is_array($colBrakes) && count($colBrakes) && $colBrakes[$counter]['colbrake']) {
                $html .= '</ul></li><li class="column"><ul>';
            }

            if ($childLevel == 0 && $counter > 5) {
                $child->setViewMoreIpad(true);
            }else{
                $child->setViewMoreIpad(false);
            }

            if ($childLevel == 0 && $counter > 12) {
                $child->setViewMore(true);
            }else{
                $child->setViewMore(false);
            }

            $html .= '<li ' . $this->_getRenderedMenuItemAttributes($child) . '>';
            $html .= '<a href="' . $child->getUrl() . '" ' . $outermostClassCode . '><span>' . $this->escapeHtml(
                $child->getName()
            ) . '</span></a>' . $this->_addSubMenu(
                $child,
                $childLevel,
                $childrenWrapClass,
                $limit
            ) . '</li>';
            $itemPosition++;
            $counter++;
        }

        if ($counter > 12 && $childLevel == 0) {
            $html .= '<li class="view-more-link desktop"><a href="javascript:void(0)">View More Categories</a></li>';
        }

        if ($counter > 5 && $childLevel == 0) {
            $html .= '<li class="view-more-link ipad"><a href="javascript:void(0)">View More Categories</a></li>';
        }

        if (is_array($colBrakes) && count($colBrakes) && $limit) {
            $html = '<li class="column"><ul>' . $html . '</ul></li>';
        }

        return $html;
    }


    /**
     * Returns array of menu item's classes
     *
     * @param \Magento\Framework\Data\Tree\Node $item
     * @return array
     */
    protected function _getMenuItemClasses(\Magento\Framework\Data\Tree\Node $item)
    {
        $classes = [];

        $classes[] = 'level' . $item->getLevel();
        $classes[] = $item->getPositionClass();

        if ($item->getLevel() == 0 && $item->getViewMore() == true) {
            $classes[] = 'hidden-category';
        }

        if ($item->getLevel() == 0 && $item->getViewMoreIpad() == true) {
            $classes[] = 'hidden-category-ipad';
        }

        if ($item->getIsCategory()) {
            $classes[] = 'category-item';
        }

        if ($item->getIsFirst()) {
            $classes[] = 'first';
        }

        if ($item->getIsActive()) {
            $classes[] = 'active';
        } elseif ($item->getHasActive()) {
            $classes[] = 'has-active';
        }

        if ($item->getIsLast()) {
            $classes[] = 'last';
        }

        if ($item->getClass()) {
            $classes[] = $item->getClass();
        }

        if ($item->hasChildren()) {
            $classes[] = 'parent';
        }

        return $classes;
    }
}
