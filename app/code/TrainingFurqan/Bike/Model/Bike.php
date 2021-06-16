<?php


namespace TrainingFurqan\Bike\Model;


use function JmesPath\search;
use Magento\Framework\Model\AbstractModel;
use phpDocumentor\Reflection\Types\Self_;
use TrainingFurqan\Bike\Api\Data\BikeInterface;
use TrainingFurqan\Bike\Api\Data\varchar;

class Bike extends AbstractModel implements BikeInterface
{

    /**
     * CMS page cache tag
     */
    const CACHE_TAG= 'bike_data';

    /**
     * @var String
     */
    protected $_cacheTag='bike_data';

    /**
     * Prefix of model events names.
     * @var String
     */
    protected $_eventPrefix='bike_data';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('TrainingFurqan\Bike\Model\ResourceModel\Bike');
    }

    /**
     * Get BikeId
     * @return int
     */
    public function getBikeId()
    {
        return $this->getData(self::BIKE_ID);
    }

    /**
     * set BikeId
     */
    public function setBikeId($bikeId)
    {
        return $this->setData(self::BIKE_ID,$bikeId);
    }

    /**
     * Get BikeName
     * @return varchar
     */
    public function getBikeName()
    {
        return $this->getData(self::BIKE_NAME);
    }

    /**
     * Set BikeName
     */
    public function setBikeName($bikeName)
    {
        return $this->setData(self::BIKE_NAME,$bikeName);
    }

    public function getCompany()
    {
        return $this->getData(self::COMPANY);
    }

    /**
     * Set Company.
     */
    public function setCompany($company)
    {
        return $this->setData(self::COMPANY,$company);
    }

    /**
     * Get Country.
     *
     * @return varchar
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * Set Country.
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY,$country);
    }

    /**
     * Get BikeDescription.
     *
     * @return varchar
     */
    public function getBikeDescription()
    {
        return $this->getDta(Self::BIKE_DESCRIPTION);
    }

    /**
     * Set BikeDescription.
     */
    public function setBikeDescription($bike_description)
    {
        return $this->setData(self::BIKE_DESCRIPTION,$bike_description);
    }

    /**
     * Get EngineType.
     *
     * @return varchar
     */
    public function getEngineType()
    {
        return $this->getData(self::ENGINE_TYPE);
    }

    /**
     * Set EngineType.
     */
    public function setEngineType($engine_type)
    {
        return $this->setData(self::ENGINE_TYPE,$engine_type);
    }

    /**
     * Get ExtraFeature.
     *
     * @return varchar
     */
    public function getExtraFeature()
    {
        return $this->getData(self::EXTRA_FEATURE);
    }

    /**
     * Set ExtraFeature.
     */
    public function setExtraFeature($extra_feature)
    {
        return $this->setData(self::EXTRA_FEATURE,$extra_feature);
    }

    /**
     * Get UsageInfo.
     *
     * @return varchar
     */
    public function getUsageInfo()
    {
        return $this->getData(self::WEIGHT);
    }

    /**
     * Set UsageInfo.
     */
    public function setUsageInfo($usage_info)
    {
        return $this->setData(self::USAGE_INFO, $usage_info);
    }

    /**
     * Get Image.
     *
     * @return varchar
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);;
    }

    /**
     * Set Image.
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * Get Color.
     *
     * @return varchar
     */
    public function getColor()
    {
        return $this->getData(self::COLOR);
    }

    /**
     * Set Color.
     */
    public function setColor($color)
    {
        return $this->setData(self::COLOR, $color);
    }

    /**
     * Get IsActive.
     *
     * @return int
     */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
     */
    public function setIsActive($is_active)
    {
        return $this->setData(self::IS_ACTIVE, $is_active);
    }

    /**
     * Get CreationTime.
     *
     * @return varchar
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Set CreationTime.
     */
    public function setCreationTime($creation_time)
    {
        return $this->setData(self::CREATION_TIME, $creation_time);
    }
    /**
     * Get UpdateTime.
     *
     * @return varchar
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Set UpdateTime.
     */
    public function setUpdateTime($update_time)
    {
        return $this->setData(self::UPDATE_TIME, $update_time);
    }
}