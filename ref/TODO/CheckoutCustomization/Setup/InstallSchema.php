<?php

namespace Ktpl\CheckoutCustomization\Setup;

/**
 * Add new columns like: address_type
 */

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * InstallSchema class
 * @package Ktpl\CheckoutCustomization\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Insert new fields in existing core magento tables.
     * 
     * @param  SchemaSetupInterface   $setup
     * @param  ModuleContextInterface $context
     * @return void
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();

        $setup->getConnection()->addColumn(
            $setup->getTable('quote'),
            'address_of',
            [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => false,
                'comment'  => 'Address Of - Home/Office/Others',
                'default'  => 'Home',
                'length'   => '255',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            'address_of',
            [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => false,
                'comment'  => 'Address Of - Home/Office/Others',
                'default'  => 'Home',
                'length'   => '255',
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_grid'),
            'address_of',
            [
                'type'     => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => false,
                'comment'  => 'Address Of - Home/Office/Others',
                'default'  => 'Home',
                'length'   => '255',
            ]
        );

        $setup->endSetUp();
    }
}
