<?php


namespace Practice\BioData\Model\ResourceModel\BioData;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
protected $_idFieldName='id';
    protected $_eventPrefix = 'biodata_info_collection';

    protected $_eventObject = 'info_collection';

protected function _construct()
{
    $this->_init('Practice\BioData\Model\BioData','Practice\BioData\Model\ResourceModel\BioData');
}
}