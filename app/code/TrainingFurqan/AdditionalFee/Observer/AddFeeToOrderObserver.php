<?php


namespace TrainingFurqan\AdditionalFee\Observer;


use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddFeeToOrderObserver implements ObserverInterface
{
    protected $helperData;

    public function __construct(
        \TrainingFurqan\AdditionalFee\Helper\Data $helperData
    ) {
        $this->helperData = $helperData;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order_fee_prec =  $this->helperData->getGeneralConfig('order_processing_fee');
        $is_apply_additional_fee  = $this->helperData->getGeneralConfig('apply_additional_fee');

        $quote = $observer->getQuote();
        $subtotal = $quote->getSubtotal();

        if(!empty($subtotal) && !empty($order_fee_prec) && !empty($is_apply_additional_fee)){
            $order_fee_price = (($subtotal * $order_fee_prec)/100);
            $quote->setData('extrafee', $order_fee_price);
        }

        return $this;
    }
}