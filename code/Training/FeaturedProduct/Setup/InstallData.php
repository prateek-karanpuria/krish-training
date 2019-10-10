<?php

/**
 * Add custom attribute 'Featured Product' with boolean value Yes/No
 * Ref: https://devdocs.magento.com/videos/fundamentals/add-new-product-attribute/
 */

namespace Training\FeaturedProduct\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface
{
    protected $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * [install description]
     * @param  ModuleDataSetupInterface $context [description]
     * @param  ModuleContextInterface $context
     */
    public function install(
        ModuleDataSetupInterface $dataSetup,
        ModuleContextInterface $context
    )
    {

        $dataSetup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $dataSetup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'featured_product',
            [
                'group' => 'General',
                'label' => 'Featured Products',
                'type' => 'int',
                'class' => 'featured_product_cls',
                'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'required' => false,
                'searchable' => true,
                'used_in_product_listing' => true,
                'visible' => true,
                'input' => 'boolean',
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'unique' => false,
                'default' => 1
            ]
        );

        $dataSetup->endSetup();
    }
}
