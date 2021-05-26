<?php


namespace SimplifiedMagento\FirstModule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
class LogTextAtCheckout implements ObserverInterface
{

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $writer=new \zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger=new \zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('Your text message');
    }
}