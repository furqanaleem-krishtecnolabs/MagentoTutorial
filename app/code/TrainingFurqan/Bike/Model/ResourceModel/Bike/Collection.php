<?php


namespace TrainingFurqan\Bike\Model\ResourceModel\Bike;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName='bike_id';
    /**
     * Define Resource Model
     */
    protected function _construct()
    {
        $this->_init('TrainingFurqan\Bike\Model\Bike','TrainingFurqan\Bike\Model\ResourceModel\Bike');
    }
}