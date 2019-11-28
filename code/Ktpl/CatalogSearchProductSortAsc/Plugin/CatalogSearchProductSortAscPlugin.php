<?php

/**
 * After plugin to update default sort order of searched product listing
 */

namespace Ktpl\CatalogSearchProductSortAsc\Plugin;

use Magento\CatalogSearch\Block\Result;

/**
 * class CatalogSearchProductSortAscPlugin
 * @package Ktpl\CatalogSearchProductSortAsc\Plugin
 */
class CatalogSearchProductSortAscPlugin
{

    /**
     * [afterSetListOrders description]
     * @param  Result $result
     * @param  $resultSet
     * @return $resultSet
     */
    public function afterSetListOrders(
        Result $result,
        $resultSet
    )
    {
         $result->getListBlock()->setDefaultDirection(
             'asc'
         );

        return $resultSet;
    }
}
