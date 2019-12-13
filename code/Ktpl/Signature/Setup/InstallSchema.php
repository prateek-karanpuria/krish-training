<?php

namespace Ktpl\Signature\Setup;

/**
 * Add new column 'customer signature' in 'quote', 'sales_order', 'sales_invoice' and 'sales_shipment' tables.
 */

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * class InstallSchema
 * @package Training\OrderDeliveryDate\Setup
 */
class InstallSchema implements InstallSchemaInterface
{

    const FIELD = 'customer_signature';

    const FIELDNAME = 'Customer Signature';


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

        $tablesToBeAltered = [
            'quote',
            'sales_order',
            'sales_invoice',
            'sales_shipment',
        ];

        foreach ($tablesToBeAltered as $table) {
            $setup->getConnection()->addColumn(
                $setup->getTable($table),
                self::FIELD,
                [
                    'type'     => Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment'  => self::FIELDNAME,
                ]
            );
        }

        $setup->endSetUp();
    }
}
