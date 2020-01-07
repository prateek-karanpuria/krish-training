<?php
namespace Ktpl\Timeslot\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Catalog\Model\ResourceModel\Product\Gallery;
use Magento\Catalog\Model\Product\Attribute\Backend\Media\ImageEntryConverter;

/**
 * Upgrade the Catalog module DB scheme
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.0', '<')) {

            $tableName = $setup->getTable('ktpl_timeslot_timeslot');
            $setup->getConnection()->addColumn($tableName, 'maximum_orders', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,                
                'unsigned' => true,
                'nullable' => true,
                'comment' => 'Maximum Number of orders per this time slot'
            ]);
        }
        if (version_compare($context->getVersion(), '2.0.1', '<')) {

            $tableName = $setup->getTable('ktpl_timeslot_timeslot');
            $setup->getConnection()->addColumn($tableName, 'cutoff_time', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'   => 255,
                'nullable' => true,
                'comment' => 'Maximum Number of orders per this time slot'
            ]);
        }
        if (version_compare($context->getVersion(), '2.0.2', '<')) {

            $tableName = $setup->getTable('ktpl_timeslot_timeslot');
            $setup->getConnection()->addColumn($tableName, 'midnight_status', [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'nullable' => true,
                'default' => '0',
                'comment' => 'Midnight'
            ]);
        }
        $setup->endSetup();
    }
}