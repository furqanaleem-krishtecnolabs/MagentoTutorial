<?php


namespace SimplifiedMagento\Attribute\etc\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // TODO: Implement install() method.
        $setup->startSetup();
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'custom_eav',
            [
                'type' => 'varchar',
                'label' => 'Test Demo TextBox',
                'input' => 'text',
                'backend'=>SimplifiedMagento\Attribute\Model\Config\Validation::class,
                'required' => false,
                'sort_order' => 3,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'Content',
                'visible'=>true,
                'used_in_product_listing'=>true
            ]
        );

        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'member_type',
            [
                'type' => 'varchar',
                'label' => 'member type',
                'input' => 'select',
                'required' => false,
                'sort_order' => 3,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'Content',
                'visible'=>true,
                'used_in_product_listing'=>true,
                'source'=>SimplifiedMagento\Attribute\Model\Config\Options::class
            ]
        );
        $setup->endSetup();
    }
}