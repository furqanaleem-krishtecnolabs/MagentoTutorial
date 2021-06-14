<?php


namespace SimplifiedMagento\BioData\Model\ResourceModel\BioData;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'biodata_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('SimplifiedMagento\BioData\Model\BioData', 'SimplifiedMagento\BioData\Model\ResourceModel\BioData');
    }
}