<?php
$installer = $this;
$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();

$setup->addAttribute('catalog_category', 'my_image', array(
    'type'          => 'varchar',
    'label'         => 'Menu Image',
    'input'         => 'image',
    'backend'       => 'catalog/category_attribute_backend_image',
    'required'      => false,
    'sort_order'    => 99,
    'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
    'group'         => 'General Information'
));
$installer->endSetup();