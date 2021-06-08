<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

use SimplifiedMagento\Database\Model\AffiliateMember;

class Save extends Action
{
    protected $pageFactory;

    protected $affiliateMember;
    protected $redirectFactory;
    public function __construct(Context $context,
PageFactory $pageFactory,
AffiliateMember $affiliateMember,
RedirectFactory $redirectFactory)
    {

        $this->redirectFactory=$redirectFactory;
        $this->affiliateMember=$affiliateMember;
        $this->pageFactory=$pageFactory;

        parent::__construct($context);
    }

   protected function _isAllowed()
   {
       return $this->_authorization->isAllowed('SimplifiedMagento_CustomAdmin::parent');
   }

    public function execute()
    {
        $data=$this->getRequest()->getPostValue();

        $resultRedirect=$this->redirectFactory->create();

        if(data){
            $member=$this->getRequest()->getParam('member');

            if(array_key_exists('entity_id',$member)){
                $id=$member['entity_id'];
                $model=$this->model->load($id);
            }
            $model=$this->model->setData($data);
        }
        try{
            $model->save();
            $this->messageManager->addSuccessMessage(__('affiliate Member saved successfully'));
            $this->_getSession()->setFormData(false);
            if($this->getRequest()->getParam('back')){
                return $resultRedirect->setPath('*/*/edit',['id' =>$model->getId(),'_current'=>true]);
            }
            return $resultRedirect->setPath('*/*/index');
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultForward->forward('edit');
    }
}