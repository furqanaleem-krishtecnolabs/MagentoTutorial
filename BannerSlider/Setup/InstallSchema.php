<?php


namespace SimplifiedMagento\BannerSlider\Setup;



use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Db\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;


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
        /*Banner Slider Table */
        $table=$setup->getConnection()->newTable(
            $setup->getTable('banners_slider')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity'=>true,'nullable'=>false,'primary'=>true,'unsigned'=>true],
            'Banner ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable'=>true],
            'NAME OF BANNER'
        )->addColumn(
            'url',
            TABLE::TYPE_TEXT,
            255,
            ['nullable'=>true],
            'IMAGE OF BANNER'
        )->addColumn(
            'status',
            Table::TYPE_BOOLEAN,
            10,
            ['nullable'=>false,'default'=>true],
            'STATUS'
        )->addColumn(
            'store_id',
            Table::TYPE_SMALLINT,
            null,
            ['unsigned' => true, 'nullable' => false],
            'STORE-ID'
        )->addColumn(
            'order',
            Table::TYPE_SMALLINT,
            null,
            ['nullable'=>true],
            'ORDER-ID'
        )->addColumn(
            'group_id',
            Table::TYPE_SMALLINT,
            null,
            ['unsigned'=>true,'nullable'=>false],
            'GROUP-ID'
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
        )->addForeignKey(
            $setup->getFkName('banners_slider','store_id','store','store_id'),
            'store_id',
            $setup->getTable('store'),
            'store_id',
            Table::ACTION_NO_ACTION
        )->addForeignKey(
            $setup->getFkName('banners_slider','group_id','banners_slider_group','id'),
            'group_id',
            $setup->getTable('banners_slider_group'),
            'id',
            Table::ACTION_NO_ACTION
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable('banners_slider'),
                ['name'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
          ['name'],
            AdapterInterface::INDEX_TYPE_FULLTEXT
        )->setComment(
            'BANNER SLIDER TABLE'
        );
        $setup->getConnection()->createTable($table);

        /*Banner Slider-Group Table */

        $table=$setup->getConnection()->newTable(
            $setup->getTable('banner_slider_group')
        )->addColumn(
            'id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Group ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Group Name'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Banner Group Creation Time'
        )->addColumn(
            'update_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' =>Table::TIMESTAMP_INIT_UPDATE],
            'Banner Group Modification Time'
        )->setComment(
            'Banner Group Table'
        );
        $setup->getConnection()->createTable($table);

        /*Store Table */
        $table=$setup->getConnection()->newTable(
            $setup->getTable('store')
        )->addColumn(
            'store_id',
            Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'Store ID'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            ['nullable' => true],
            'Store Name'
        )->addColumn(
            'creation_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Store Creation Time'
        )->addColumn(
            'update_time',
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' =>Table::TIMESTAMP_INIT_UPDATE],
            'Store Modification Time'
        )->setComment(
            'Store Table'
        );
        $setup->getConnection()->createTable($table);
        $setup->endSetup();
    }
}