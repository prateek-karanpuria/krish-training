<?php

namespace Training\Testimonial\Setup;

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

    ## REMEMBER TO Upgrade the module version in etc/module.xml before doing setup upgrade

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'custom_eav',
            [
                'group' => 'General',
                'type' => 'text',
                'backend' => \Training\Testimonial\Model\Config\Validation::class,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'required' => true,
                'searchable' => false,
                'used_in_product_listing' => true,
                'visible' => true,
                'label' => 'Custom EAV',
                'input' => 'text',
            ]
        );

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'member_type',
            [
                'group' => 'General',
                'type' => 'text',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'required' => true,
                'searchable' => false,
                'used_in_product_listing' => true,
                'visible' => true,
                'label' => 'Member Type',
                'input' => 'select',
                'source' => \Training\Testimonial\Model\Config\Options::class,
            ]
        );

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'test',
            [
                'group' => 'General',
                'type' => 'text',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'required' => false,
                'searchable' => false,
                'used_in_product_listing' => true,
                'visible' => true,
                'label' => 'Test Attribute',
                'input' => 'text'
            ]
        );

        $setup->endSetup();
    }

}
