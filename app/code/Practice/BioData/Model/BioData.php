<?php


namespace Practice\BioData\Model;


use Magento\Framework\Model\AbstractModel;

class BioData extends AbstractModel
{
    const CACHE_TAG = 'Practice_BioData';

    //Unique identifier for use within caching
    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init('Practice\BioData\Model\ResourceModel\BioData');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}


