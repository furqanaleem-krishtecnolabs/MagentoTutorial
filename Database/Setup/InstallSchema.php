<?php


namespace SimplifiedMagento\Database\Setup;

use Magento\Backend\Block\Widget\Tab;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Db\Ddl\Table;
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
        $table=$setup->getConnection()->newTable(
            $setup->getTable('affiliate_member')
        )->addColumn(
            'entity_id',
                Table::TYPE_INTEGER,
                null,
                ['identity'=>true,'nullable=>false','primary'=>true],
                'MEMBER ID'
            )->addColumn(
                'name',
                Table::TYPE_TEXT,
                255,
                ['nullable'=>false],
                'NAME OF MEMBER'
            )->addColumn(
                'address',
                Table::TYPE_TEXT,
                255,
                ['nullable'=>false],
                'ADDRESS OF MEMBER'
            )->addColumn(
                'status',
                Table::TYPE_BOOLEAN,
                10,
                ['nullable'=>false,'default'=>false],
                'STATUS'
            )->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT],
                'TIME CREATED'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT_UPDATE],
                'TIME FOR UPDATE'
            )->setComment(
                'Affiliated Member table'


        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}