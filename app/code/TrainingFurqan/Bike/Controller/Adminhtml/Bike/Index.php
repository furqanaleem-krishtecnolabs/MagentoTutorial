<?php


namespace TrainingFurqan\Bike\Controller\Adminhtml\Bike;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
)
    {
        parent::__construct($context);
        $this->_resultPageFactory=$resultPageFactory;
    }

    /**
     * Grid list page
     * @return \Magento\Backend\Model\View\Result\Page
     */


    public function execute()
    {
        $reultPage=$this->_resultPageFactory->create();
        $reultPage->setActiveMenu('TrainingFurqan_Bike::bike_list');
        $reultPage->getConfig()->getTitle()->prepend(__('Bike List'));
        return $reultPage;
    }

    /**
     * Check grid list permissions
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingFurqan_Bike::bike_list');
    }
}