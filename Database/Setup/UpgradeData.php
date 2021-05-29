<?php


namespace SimplifiedMagento\Database\Setup;


use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface

{

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
    if(version_compare($context->getVersion(),'0.0.3','<')){

    }
        $setup->getConnection()->insert(
            $setup->getTable('affiliate_member'),
            ['name'=>'Ade','status'=>true,'address'=>'no 13 Dubai','phone_number'=>'8669127064']
        );
        $setup->endSetup();
    }
}