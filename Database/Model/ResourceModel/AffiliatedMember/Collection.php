<?php


namespace SimplifiedMagento\Database\Model\ResourceModel\AffiliatedMember;

use SimplifiedMagento\Database\Model\AffiliateMember;
use PhpCollection\AbstractCollection;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember as AffiliateMemeberResource;
class Collection extends AbstractCollection
{
    protected function _construct(){
        parent::_construct();
        $this->_init(AffiliateMember::class,AffiliateMemeberResource::class);

    }
}