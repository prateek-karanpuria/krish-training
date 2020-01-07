<?php


namespace Ktpl\Timeslot\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $table_ktpl_timeslot_timeslot = $setup->getConnection()->newTable($setup->getTable('ktpl_timeslot_timeslot'));

        $table_ktpl_timeslot_timeslot->addColumn(
            'timeslot_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'country_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Country'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'state_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'State'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'region',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'Region Text'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'city_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'city_id'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'start_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'start_date'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'end_date',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'End Date'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'shipping_charge',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'shipping_charge'
        );

        $table_ktpl_timeslot_timeslot->addColumn(
            'module_status',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'module_status'
        );

        $setup->getConnection()->createTable($table_ktpl_timeslot_timeslot);
    }
}
