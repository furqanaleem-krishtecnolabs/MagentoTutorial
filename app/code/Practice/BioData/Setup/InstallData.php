<?php


namespace Practice\BioData\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $date;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $dataNewsRows = [
            [
                'name' => 'abc',
                'mother_name' => 'xyz',
                'age' => '12',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'name' => 'pqr',
                'mother_name' => 'xyz',
                'age' => '13',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ]
        ];

        foreach($dataNewsRows as $data) {
            $setup->getConnection()->insert($setup->getTable('bio_data'), $data);
        }
    }
}
