<?php


namespace Practice\BioData\Controller\Adminhtml\Info;


use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
//    protected $helperData;
//    protected  $bioDataFactory;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
//        \Practice\BioData\Helper\Data $helperData,
//        \Practice\BioData\Model\BioDataFactory $bioDataFactory
        )
    {
        $this->resultPageFactory=$resultPageFactory;
//        $this->helperData=$helperData;
//        $this->bioDataFactory=$bioDataFactory;
        parent::__construct($context);
    }


    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Practice_BioData::biodata_info');
    }
    public function execute()
    {
//        $is_enable=$this->helperData->getGeneralConfig('enable');
//        if($is_enable=1)
//        {
//            echo $this->helperData->getStoreFrontConfig('bio_link');
//            exit();
//        }

//        $biodata=$this->bioDataFactory->create();

//        $info=$biodata->load(1);
//        var_dump($info->getData());
//        $biodataCollection=$biodata->getCollection();
//
//        print_r($biodataCollection->getData());
        $resultPage=$this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Bio Info'));
        return $resultPage;
    }
}