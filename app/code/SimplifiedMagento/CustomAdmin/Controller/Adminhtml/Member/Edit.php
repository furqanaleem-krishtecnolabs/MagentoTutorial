<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;
use SimplifiedMagento\Database\Model\AffiliateMember;

class Edit extends Action
{
    protected $pageFactory;
    protected $affiliateMember;
    protected $registry;
        public function __construct(Context $context,
PageFactory $pageFactory,AffiliateMember $affiliateMember,
Registry $registry)
        {
            $this->registry=$registry;
            $this->pageFactory=$pageFactory;
            $this->affiliateMember=$affiliateMember;
            parent::__construct($context);
        }
        protected function _isAllowed()
        {
            return $this->_authorization->isAllowed('SimplifiedMagento_CustomAdmin');
        }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id=$this->getRequest()->getParam('id');
        $model=$this->affiliateMember;
        if($id){
            $model->load($id);
            if(!$model->getId()){
                $this->messageManager->addErrorMessage(__('this member does nt exist'));
                $result=$this->resultRedirectFactory->create();
                return $result->setPath('affiliate\member\index');

            }

        }
        $data=$this->_getSession()->getFormData(true);
        if(!empty($data)){
            $model->setData($data);
        }
        $this->registry->registry('member',$model);
        $resultPage=$this->pageFactory->create();
        $resultPage->addBreadcrumb($id ? __('Edit Member'): __('Add Member'));
        if($id){
            $resultPage->getConfig()->getTitle()->prepend('Edit');

        }else{
            $resultPage->getConfig()->getTitle()->prepend('Add');
        }
        return $resultPage;


    }
}