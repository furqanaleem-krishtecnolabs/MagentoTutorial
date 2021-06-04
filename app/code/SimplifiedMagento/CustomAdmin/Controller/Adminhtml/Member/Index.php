<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\ResponseInterface;

class Index extends Action
{
    private $pageFactory;
    public function __construct(Context $context,
PageFactory $pageFactory)
    {
        $this->pageFactory=$pageFactory;
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
        return $this->pageFactory->create();
    }
}