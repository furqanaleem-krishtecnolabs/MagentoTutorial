<?php


namespace Practice\BioData\Model;


use Magento\Framework\Model\AbstractModel;
use Practice\BioData\Api\Data\BioDataInterface;

class BioData extends AbstractModel implements BioDataInterface
{
    const STATUS_ENABLED=1;
    const STATUS_DISABLED=0;
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

    public function getAvailableStatuses(){
        return [self::STATUS_ENABLED=>_('Enabled'),self::STATUS_DISABLED=>_('Disabled')];
    }
    public function getId()
    {
        return parent::getData(self::ID);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }


    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }

}


