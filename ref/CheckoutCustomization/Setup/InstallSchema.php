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
            $setup->getTable('quote_address'),
            'address_of',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => false,
                'unsigned' => true,
                'comment' => 'Address Of - home=0/office=1/others=2',
                'default' => 0,
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order_address'),
            'address_of',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => false,
                'unsigned' => true,
                'comment' => 'Address Of - home=0/office=1/others=2',
                'default' => 0,
            ]
        );

        $setup->getConnection()->addColumn(
            $setup->getTable('customer_address_entity'),
            'address_type',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                'nullable' => false,
                'unsigned' => true,
                'comment' => 'Address Type - home=0/office=1/others=2',
                'default' => 0,
            ]
        );

        $setup->endSetUp();
    }
}
