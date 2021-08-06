<?php


namespace Practice\BioData\Controller\Adminhtml\Info;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }



    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\BioData
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\BioData $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Practice_BioData::biodata_info')
            ->addBreadcrumb(__('BioData'), __('BioData'))
            ->addBreadcrumb(__('Manage All BioData'), __('Manage All BioData'));
        return $resultPage;
    }

    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Practice_BioData::save');
    }

    /**
     * Edit BioData
     *
     * @return \Magento\Backend\Model\View\Result\BioData|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create('Practice\BioData\Model\BioData');

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('biodata_info', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\BioData $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit BioData') : __('Add BioData'),
            $id ? __('Edit BioData') : __('Add BioData')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('BioData'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('Add BioData'));

        return $resultPage;
    }
}