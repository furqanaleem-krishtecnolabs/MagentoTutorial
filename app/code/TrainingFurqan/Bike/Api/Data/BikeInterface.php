<?php


namespace TrainingFurqan\Bike\Api\Data;


interface BikeInterface
{
    /**
     * Constants for keys of data array.
     */
    const BIKE_ID='bike_id';
    const BIKE_NAME='bike_name';
    const COMPANY='company';
    const COUNTRY='country';
    const BIKE_DESCRIPTION='bike_description';
    const ENGINE_TYPE='engine_type';
    const EXTRA_FEATURE='extra_feature';
    const USAGE_INFO='usage_info';
    const IMAGE='image';
    const COLOR='color';
    const IS_ACTIVE='is_active';
    const CREATION_TIME='creation_time';
    const UPDATE_TIME='update_time';

    /**
     * Get BikeId
     * @return int
     */
    public function getBikeId();

    /**
     * set BikeId
     */
    public function setBikeId($bikeId);

    /**
     * Get BikeName
     * @return varchar
     */
    public function getBikeName();

    /**
     * Set BikeName
     */
    public function setBikeName($bikeName);

    public function getCompany();

    /**
     * Set Company.
     */
    public function setCompany($company);

    /**
     * Get Country.
     *
     * @return varchar
     */
    public function getCountry();

    /**
     * Set Country.
     */
    public function setCountry($country);

    /**
     * Get BikeDescription.
     *
     * @return varchar
     */
    public function getBikeDescription();

    /**
     * Set BikeDescription.
     */
    public function setBikeDescription($bike_description);

    /**
     * Get EngineType.
     *
     * @return varchar
     */
    public function getEngineType();

    /**
     * Set EngineType.
     */
    public function setEngineType($engine_type);

    /**
     * Get ExtraFeature.
     *
     * @return varchar
     */
    public function getExtraFeature();

    /**
     * Set ExtraFeature.
     */
    public function setExtraFeature($extra_feature);

    /**
     * Get UsageInfo.
     *
     * @return varchar
     */
    public function getUsageInfo();

    /**
     * Set UsageInfo.
     */
    public function setUsageInfo($usage_info);

    /**
     * Get Image.
     *
     * @return varchar
     */
    public function getImage();

    /**
     * Set Image.
     */
    public function setImage($image);

    /**
     * Get Color.
     *
     * @return varchar
     */
    public function getColor();

    /**
     * Set Color.
     */
    public function setColor($color);

    /**
     * Get IsActive.
     *
     * @return int
     */
    public function getIsActive();

    /**
     * Set IsActive.
     */
    public function setIsActive($is_active);


    /**
     * Get UpdateTime.
     *
     * @return varchar
     */
    public function getUpdateTime();

    /**
     * Set UpdateTime.
     */
    public function setUpdateTime($update_time);


    /**
     * Get CreationTime.
     *
     * @return varchar
     */
    public function getCreationTime();

    /**
     * Set CreationTime.
     */
    public function setCreationTime($creation_time);


}