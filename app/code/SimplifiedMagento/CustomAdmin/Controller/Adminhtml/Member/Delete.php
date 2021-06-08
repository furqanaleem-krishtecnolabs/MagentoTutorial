<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use SimplifiedMagento\Database\Model\AffiliateMember;

class Delete extends Action
{
    protected $model;
    protected $pageFactory;
    protected $affiliateMember;
    protected $redirectFactory;
    public function __construct(Context $context,
PageFactory $pageFactory,
AffiliateMember $affiliateMember,
RedirectFactory $redirectFactory)
    {
        $this->pageFactory=$pageFactory;
        $this->affiliateMember=$affiliateMember;
        $this->redirectFactory=$redirectFactory;
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
        $resultRedirect=$this->resultRedirectFactory->create();
        $id=$this->getRequest()->getParam('id');
        if($id){
            $model=$this->model;
            $model->load($id);
            try{
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Member deleted'));
                return $resultRedirect->setPath('*/*/index');
            }catch (\Exception $e){
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                return $resultRedirect->setPath('*/*/edit',['id' =>$id]);
            }
        }
        return $resultRedirect->setPath('*/*/index');
    }
}