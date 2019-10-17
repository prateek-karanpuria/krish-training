<?php

/**
 * Add new delivery date column
 */

namespace Training\OrderDeliveryDate\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * class InstallSchema
 * @package Training\OrderDeliveryDate\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * [install description]
     * @param  SchemaSetupInterface   $setup   [description]
     * @param  ModuleContextInterface $context [description]
     * @return [type]                          [description]
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();

        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'delivery_date',
            [
                'type' => 'datetime',
                'nullable' => false,
                'comment' => 'Delivery Date'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'delivery_date',
            [
                'type' => 'datetime',
                'nullable' => false,
                'comment' => 'Delivery Date'
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'delivery_date',
            [
                'type' => 'datetime',
                'nullable' => false,
                'comment' => 'Delivery Date'
            ]
        );

        $setup->endSetUp();
    }
}
