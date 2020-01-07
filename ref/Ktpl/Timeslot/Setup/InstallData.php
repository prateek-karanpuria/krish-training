<?php
namespace Ktpl\Timeslot\Setup;
 
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Quote\Setup\QuoteSetupFactory;
 
/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
 
    /**
     * @var QuoteSetupFactory
     */
    private $quoteSetupFactory;
 
    /**
     * @var SalesSetup
     */
    private $salesSetupFactory;
 
    /**
     * InstallData constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param QuoteSetupFactory $quoteSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        QuoteSetupFactory $quoteSetupFactory,
        SalesSetupFactory $salesSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
        $this->salesSetupFactory = $salesSetupFactory;
    }
 
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var QuoteSetup $quoteSetup */
        $quoteSetup = $this->quoteSetupFactory->create(['setup' => $setup]);
 
        /** @var SalesSetup $salesSetup */
        // $salesSetup = $this->salesSetupFactory->create(['setup' => $setup]);

 
        $attributeOptions = [
            'type'     => Table::TYPE_TEXT,
            'visible'  => true,
            'required' => false
        ];
        $quoteSetup->addAttribute('quote', 'timeslot_id', $attributeOptions);
        // $salesSetup->addAttribute('order_item', 'dropdown_attribute', $attributeOptions);

        $quoteSetup->addAttribute('quote', 'timeslot_time', $attributeOptions);
        // $salesSetup->addAttribute('order_item', 'dropdown_attribute', $attributeOptions);

        $quoteSetup->addAttribute('quote', 'timeslot_rate', $attributeOptions);
        // $salesSetup->addAttribute('order_item', 'dropdown_attribute', $attributeOptions);
    }
}