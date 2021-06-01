<?php


namespace SimplifiedMagento\Database\Api\Data;


Interface AffiliateMemberInterface
{
    const NAME='name';
    const ID='entity_id';
    const STATUS='status';
    const  ADDRESS='address';
    const PHONE_NUMBER='phone_number';
    const CREATED_AT='created_at';
    const UPDATED_AT='updated_at';

    public function getId();
    public function getName();
    public function getStatus();
    public function getAddress();
    public function getPhoneNumber();
    public function getCreatedAt();
    public function getUpdatedAt();

    /**
     * @param $id
     * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
     */
    public function setId($id);

    /**
     * @param $name
     * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
     */
    public function setName($name);

    public function setStatus($status);
    public function setPhoneNumber($phoneNumber);
    public function setAddress($address);
}