<?php


namespace SimplifiedMagento\Database\Model;
//use SimplifiedMagento\Database\Model\AffiliateMember;
use Magento\Framework\Model\AbstractModel;
use SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface;

use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember as AffliliateMemberResource;
class AffiliateMember extends AbstractModel implements AffiliateMemberInterface
{
    protected function _construct()
    {
        $this->_init(AffliliateMemberResource::class);
    }

    public function getName()
    {
        return $this->getData(AffiliateMemberInterface::NAME);
    }

    public function getStatus()
    {
        return $this->getData(AffiliateMemberInterface::STATUS);
    }

    public function getAddress()
    {
        return $this->getData(AffiliateMemberInterface::ADDRESS);
    }

    public function getPhoneNumber()
    {
        return $this->getData(AffiliateMemberInterface::PHONE_NUMBER);
    }

    public function getCreatedAt()
    {
        return $this->getData(AffiliateMemberInterface::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(AffiliateMemberInterface::UPDATED_AT);
    }
    public function getId()
    {
        return $this->getData(AffiliateMemberInterface::ID);
    }
    /**
     * @param $name
     * @return \SimplifiedMagento\Database\Api\Data\AffiliateMemberInterface
     */
    public function setName($name)
    {
        // TODO: Implement setName() method.
        $this->setData(AffiliateMemberInterface::NAME,$name);
    }

    public function setStatus($status)
    {
        // TODO: Implement setStatus() method.
        $this->setData(AffiliateMemberInterface::STATUS,$status);
    }

    public function setPhoneNumber($phoneNumber)
    {
        // TODO: Implement setPhoneNumber() method.
        $this->setData(AffiliateMemberInterface::UPDATED_AT,$phoneNumber);
    }


    public function setAddress($address)
    {
        // TODO: Implement setAddress() method.
        $this->setData(AffiliateMemberInterface::ADDRESS,$address);
    }
}