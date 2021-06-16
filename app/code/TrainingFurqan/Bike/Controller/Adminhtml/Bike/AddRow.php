<?php


namespace TrainingFurqan\Bike\Controller\Adminhtml\Bike;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
class AddRow extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \TrainingFurqan\Bike\Model\BikeFactory
     */
    private $bikeFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \TrainingFurqan\Bike\Model\BikeFactory $bikeFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \TrainingFurqan\Bike\Model\BikeFactory $bikeFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->bikeFactory = $bikeFactory;
    }
    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->bikeFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getBikeId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('bike/bike/rowdata');
                return;
            }
        }
        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit bike').$rowTitle : __('Add bike');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingFurqan_Bike::add_row');
    }
}