<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use SimplifiedMagento\Database\Model\AffiliateMember;

class InlineEdit extends Action
{

    protected $affiliateMember;
    protected $jsonFactory;
    public function __construct(Context $context,
AffiliateMember $affiliateMember,
JsonFactory $jsonFactory)
    {
        $this->affiliateMember=$affiliateMember;
        $this->jsonFactory=$jsonFactory;
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
        $resultJson=$this->jsonFactory->create();
        $error=false;
        $message=[];

        if($this->getRequest()->getParam('isAjax')){
            $postItems=$this->getRequest()->getParam('items',[]);

            if(!count($postItems)){
                $message[]=__('Please correct data sent');
                $error=true;

            }else{
                foreach (array_keys($postItems) as $modelId){
                    $model=$this->affiliateMember->load($modelId);
                    try{
                        $model->setData(array_merge($model->getData(),$postItems[$modelId]));
                        $model->save();
                    }catch (\Exception $e){
                        $message[]=$e->getMessage();
                        $error=true;
                    }
                }
            }
        }
        return $resultJson->setData([
            'message' =>$message,
            'error' =>$error
        ]);
    }
}