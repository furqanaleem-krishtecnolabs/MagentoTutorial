<?php


namespace Practice\TransactionalEmail\Observer;


use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class CustomerLoginSuccess implements ObserverInterface
{
    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        // If customer data is empty then doesn't need to process
        if (!$customer) {
            return $this;
        }

        /* Receiver Detail */
        $receiverInfo = [
            'name' => 'Cuong Ngo',
            'email' => 'bestearnmoney87+100@gmail.com'
        ];

        $store = $this->storeManager->getStore();

        $templateParams = ['store' => $store, 'customer' => $customer, 'administrator_name' => $receiverInfo['name']];

        $transport = $this->transportBuilder->setTemplateIdentifier(
            'practice_transactional_email_customer_logged_in_email_template'
        )->setTemplateOptions(
            ['area' => 'frontend', 'store' => $store->getId()]
        )->addTo(
            $receiverInfo['email'], $receiverInfo['name']
        )->setTemplateVars(
            $templateParams
        )->setFrom(
            'general'
        )->getTransport();

        try {
            // Send an email
            $transport->sendMessage();
        } catch (\Exception $e) {
            // Write a log message whenever get errors
            $this->logger->critical($e->getMessage());
        }
        return $this;
    }
}