<?php


namespace TrainingFurqan\CustomerIP\Observer;


use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Customer;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class CustomerLogin implements ObserverInterface
{
    protected $_customerRepositoryInterface;
    private $remoteAddress;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        RemoteAddress $remoteAddress
    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->remoteAddress = $remoteAddress;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $current_visitor_ip = $this->remoteAddress->getRemoteAddress();
        $customer = $observer->getEvent()->getCustomer();
        $customerData = $customer->getDataModel();
        $customerData->setCustomAttribute('customer_ip_address', $current_visitor_ip);
        $customer->updateData($customerData);
        $customer->save();
    }
}