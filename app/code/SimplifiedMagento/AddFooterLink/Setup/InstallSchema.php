<?php


namespace SimplifiedMagento\AddFooterLink\Setup;


use GraphQL\Type\Definition\IDType;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName=$setup->getTable('created_article');

        if($setup->getConnection()->isTableExists($tableName)!=true){

            $table=$setup->getConnection()->newTable($tableName)
                ->addColumn(
                    'article_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity'=>true,
                        'unsigned'=>true,
                        'nullable'=>false,
                        'primary'=>true
                    ]
                )->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false]

                )->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false]

                )->addColumn('created_at',
                Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT]

                )->setComment('created article');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();

    }
}