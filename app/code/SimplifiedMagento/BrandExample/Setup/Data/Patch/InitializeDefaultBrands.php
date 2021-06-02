<?php


namespace SimplifiedMagento\BrandExample\Setup\Data\Patch;


use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchInterface;

class InitializeDefaultBrands implements DataPatchInterface

{
    private $moduleDataSetup;
    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup=$moduleDataSetup;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [
            \Magento\Store\Setup\Patch\Schema\InitializeStoresAndWebsites::class
        ];

    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return [
            \SimplifiedMagento\BrandExample\Setup\Data\Patch\CreateDefaultBrands::class
        ];
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
        $brands=[
            ['name'=>'Sike','description'=>'something cool'],
            ['name'=>'Luma','description'=>'Something not quit as cool'],
            ['name'=>'Babidas','description'=>'to cool to care'],
        ];
        $records=array_map(function ($brand){
            return array_merge($brand,['is_enabled'=>1,'website_id'=>1]);
        },$brands);
        $this->moduleDataSetup->getConnection()->insertMultiple('simplified_magento_brand_example',$records);
        return $this;
    }
}