<?php


namespace Ktpl\PurchaseOrder\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();

        if ($connection->tableColumnExists('quote', 'dc_po_number') === false) {
            $connection
                ->addColumn(
                    $setup->getTable('quote'),
                    'dc_po_number',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'length' => 0,
                        'comment' => 'DC PO Number'
                    ]
                );
        }
        $installer->endSetup();
    }
}
