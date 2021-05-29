<?php


namespace SimplifiedMagento\Database\Model;
//use SimplifiedMagento\Database\Model\AffiliateMember;
use Magento\Framework\Model\AbstractModel;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember as AffliliateMemberResource;
class AffiliateMember extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(AffiliateMember::class,AffliliateMemberResource::class);
    }
}