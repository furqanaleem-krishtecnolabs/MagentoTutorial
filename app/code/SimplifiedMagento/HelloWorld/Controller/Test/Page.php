<?php


namespace SimplifiedMagento\HelloWorld\Controller\Test;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;


class Page extends Action
{
    protected $pageFactory;

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