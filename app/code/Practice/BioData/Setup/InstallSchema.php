<?php


namespace Practice\BioData\Setup;


use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        $newsTableName = $setup->getTable('bio_data');

        if($setup->getConnection()->isTableExists($newsTableName) != true) {

            $newsTable = $setup->getConnection()
                ->newTable($newsTableName)
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'name'
                )
                ->addColumn(
                    'mother_name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => ''],
                    'mother_name'
                )
                ->addColumn(
                    'age',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    20,
                    ['nullable' => false, 'unsigned' => true],
                    'age'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
                    null,
                    ['nullable' => false],
                    'Updated At'
                )
                ->setComment("BioData Table");

            $setup->getConnection()->createTable($newsTable);
        }
    }
}
?>