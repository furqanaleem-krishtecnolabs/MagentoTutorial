<?php


namespace TrainingFurqan\AdditionalFee\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.5') <= 0)
        {

            $setup->startSetup();

            //Quote tables
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable('quote'),
                    'extrafee',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        'length'=>'10,2',
                        'default' => 0.00,
                        'nullable' => true,
                        'comment' =>'Extra Fee'

                    ]
                );

            $setup->endSetup();
        }
    }
}