<?php

/**
 * Install data script to add custom attributes
 */

namespace Training\CustomProductContentTab\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * class InstallData
 * @package Training\CustomProductContentTab\Setup
 */
class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Zend_Validate_Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'custom_title',
                [
                    'group' => 'Custom Section',
                    'type' => 'text',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Title',
                    'input' => 'text',
                    'class' => '',
                    'source' => '',
                    'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => true,
                    'user_defined' => false,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => true,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => ''

            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'custom_comment',
            [
                'group' => 'Custom Section',
                'type' => 'text',
                'backend' => '',
                'frontend' => '',
                'label' => 'Comment',
                'input' => 'textarea',
                'class' => '',
                'source' => '',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'wysiwyg_enabled' => true,
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => true,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => ''
           ]
        );
    }
}
