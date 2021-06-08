<?php


namespace SimplifiedMagento\CustomAdmin\Block\Adminhtml\Member\Edit;


use Magento\Framework\Registry;

class Generic
{
    protected $urlBuilder;
    protected $registry;
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        Registry $registry
    )
    {
        $this->urlBuilder=$context->getUrlBuilder();
        $this->registry=$registry;
    }

    public function getId(){
        $member=$this->registry->registry('member');
        return $member ? $member->getId() :null;
    }
    public function getUrl($route='',$param=[]){
        return $this->urlBuilder->getUrl($route,$param);
    }
}