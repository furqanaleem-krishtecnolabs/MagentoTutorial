<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;

class Index extends Action
{
    private $scopeConfig;

    public function __construct(Context $context,
ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig=$scopeConfig;
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
        echo $this->scopeConfig->getValue('First_section/First_group/First_field');
        print_r($this->scopeConfig->getValue('First_section/First_group/Third_field'));
    }
}