<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;



use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\view\Result\PageFactory;

class NewAction extends Action
{
    protected $forwardFactory;
    protected $pageFactory;
    public function __construct(
        PageFactory $pageFactory,
        ForwardFactory $forwardFactory,
        Action\Context $context)
    {
        $this->pageFactory=$pageFactory;
        $this->forwardFactory=$forwardFactory;
        parent::__construct($context);
    }
    protected function _isAllowed()
    {
       return $this->_authorization->isAllowed('SimplifiedMagento_CustomAdmin::parent');
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultForward = $this->forwardFactory->create();
        return $resultForward->forward('edit');
        // TODO: Implement execute() method.
    }
}