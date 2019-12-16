<?php

namespace Ktpl\SpranksConfigurableTierPrices\Setup;

/**
 * Install data script to add custom attributes
 */

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * class InstallData
 * @package Ktpl\SpranksConfigurableTierPrices\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetupFactory $eavSetupFactory
     */
    public $eavSetupFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            Ktpl\SpranksConfigurableTierPrices\Helper\Data::ATTRIBUTE_DISABLED_FOR_PRODUCT,
            [
                'group' => 'General',
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'backend' => \Magento\Catalog\Model\Product\Attribute\Backend\Boolean::class,
                'frontend' => '',
                'label' => 'Disable Spranks Configurable Tier Prices',
                'input' => 'select',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'default' => false,
                'filterable_in_search' => false,
                'used_in_product_listing' => true,
            ]
        );

        $eavSetup->endSetup();
    }
}
