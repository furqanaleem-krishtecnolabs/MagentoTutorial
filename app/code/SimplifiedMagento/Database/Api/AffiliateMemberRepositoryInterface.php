<?php


namespace SimplifiedMagento\Database\Api;


Interface AffiliateMemberRepositoryInterface
{
    /**
     * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface[]
     */
    public function getList();
}