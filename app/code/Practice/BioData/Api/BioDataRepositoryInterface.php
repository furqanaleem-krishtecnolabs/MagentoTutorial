<?php


namespace Practice\BioData\Api;


Interface BioDataRepositoryInterface
{
    public function save(\Practice\BioData\Api\Data\BioDataInterface $bioData);

    public function getById($Id);

    public function delete(\Practice\BioData\Api\Data\BioDataInterface $bioData);

    public function deleteById($Id);
}