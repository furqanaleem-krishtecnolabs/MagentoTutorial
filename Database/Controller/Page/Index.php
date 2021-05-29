<?php


namespace SimplifiedMagento\Database\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use SimplifiedMagento\Database\Model\AffiliateMemberFactory;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliateMember;
class Index extends Action
{
    protected $affiliateMemberFactory;
    public function __construct(Context $context,AffiliateMemberFactory $affiliateMemberFactory)
    {
        $this->affiliateMemberFactory=$affiliateMemberFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $affiliateMember=$this->affiliateMemberFactory->create();
//        $member=$affiliateMember->load(1);
//        $member->delete();
//        $member->setAddress('new address');
//        $member->save();
//        var_dump($member->getData());
//        $affiliateMember->addData(['name'=>'Rand','address'=>'a new address','status'=>false,'phone_number'=>'9423719134']);
//        $affiliateMember->save();
        $collection=$affiliateMember->getCollection();
        foreach($collection as $item){
            print_r($item->getData());
            echo '</br>';
        }
    }
}