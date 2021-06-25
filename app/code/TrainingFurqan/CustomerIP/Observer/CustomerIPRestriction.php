<?php


namespace TrainingFurqan\CustomerIP\Observer;


use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Exception\LocalizedException;

class CustomerIPRestriction implements ObserverInterface
{
    private $remoteAddress;
    protected $rowCollection;
    protected $collection;
    protected $helperData;

    public function __construct(
        RemoteAddress $remoteAddress,
        \TrainingFurqan\CustomerIP\Helper\Data $helperData
    ) {
        $this->remoteAddress = $remoteAddress;

        $this->helperData = $helperData;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $current_visitor_ip = $this->remoteAddress->getRemoteAddress();

        $is_module_enable = $this->helperData->getGeneralConfig('enable');
        if(!$is_module_enable){
            return;
        }

        $restricted_ip_address_arr = array();
        $restricted_ip_address = $this->helperData->getGeneralConfig('restricted_ip_address');
        $restricted_ip_address_arr = explode(",",$restricted_ip_address);

        if(!empty($restricted_ip_address_arr)){
            if(in_array($current_visitor_ip,$restricted_ip_address_arr)){
                throw new LocalizedException(__('Your IP Address is Restricted.'));
            }else {
                return;
            }
        }else {
            return;
        }
    }

}