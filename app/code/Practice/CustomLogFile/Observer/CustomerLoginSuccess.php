<?php


namespace Practice\CustomLogFile\Observer;


use Magento\Framework\Event\Observer;

class CustomerLoginSuccess implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Practice\CustomLogFile\Logger\Customer
     */

    protected $loggerCustomer;

    public function __construct(
        \Practice\CustomLogFile\Logger\Customer $loggerCustomer
    )
    {
        $this->loggerCustomer = $loggerCustomer;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $customer=$observer->getEvent()->getCustomer();
        $this->loggerCustomer->debug('Customer Name:'.$customer->getName().' has been logged in successfully..!');
    }
}