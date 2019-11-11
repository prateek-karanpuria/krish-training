<?php


namespace Ktpl\General\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{

    private $eavSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        if (version_compare($context->getVersion(), "1.0.1", "<")) {
        
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'category_image_mobile',
                [
                    'type' => 'varchar',
                    'label' => 'Category Image - Mobile',
                    'input' => 'image',
                    'sort_order' => 333,
                    'source' => '',
                    'global' => 1,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => null,
                    'group' => 'General Information',
                    'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image'
                ]
            );
        }
    }
}
