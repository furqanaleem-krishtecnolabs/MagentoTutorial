<?php


namespace Practice\BioData\Api\Data;


Interface BioDataInterface
{
    const ID = 'id';
    const NAME  = 'name';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getId();

    public function getName();

    public function getStatus();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function setId($id);

    public function setName($name);

    public function setStatus($status);

    public function setCreatedAt($created_at);

    public function setUpdatedAt($updated_at);
}
