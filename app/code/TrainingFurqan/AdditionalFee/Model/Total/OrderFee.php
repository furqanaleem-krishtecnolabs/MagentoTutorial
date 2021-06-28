<?php


namespace TrainingFurqan\AdditionalFee\Model\Total;



class OrderFee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{

    protected $quoteValidator = null;
    protected $helperData;
    protected $cart;
    protected $checkoutSession;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator,
                                \TrainingFurqan\AdditionalFee\Helper\Data $helperData,
                                \Magento\Checkout\Model\Cart $cart,
                                \Magento\Checkout\Model\Session $checkoutSession
    )
    {
        $this->quoteValidator = $quoteValidator;
        $this->helperData = $helperData;
        $this->cart = $cart;
        $this->checkoutSession = $checkoutSession;
    }
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);

        $order_fee =  $this->helperData->getGeneralConfig('order_processing_fee');
        $is_apply_additional_fee  = $this->helperData->getGeneralConfig('apply_additional_fee');

        if(!empty($is_apply_additional_fee) && !empty($order_fee)){
            $subtotal = $total->getSubtotal();
            if(empty($subtotal)){
                $order_fee = 0;
            }
            if(!empty($subtotal) && !empty($order_fee)){
                $order_fee = (($subtotal * $order_fee)/100);
            }

            $exist_amount = 0;
            $order_fee = $order_fee;
            $balance = $order_fee - $exist_amount;

            $total->setTotalAmount('extrafee', $balance);
            $total->setBaseTotalAmount('extrafee', $balance);

            $total->setFee($balance);
            $total->setBaseFee($balance);

            //  $total->setGrandTotal($total->getGrandTotal() + $balance);
            $total->setBaseGrandTotal($total->getBaseGrandTotal() + $balance);
        }

        return $this;
    }

    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }

    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $order_fee =  $this->helperData->getGeneralConfig('order_processing_fee');
        $quote = $this->checkoutSession->getQuote();
        $subtotal = $quote->getSubtotal();

        if(!empty($subtotal) && !empty($order_fee)){
            $order_fee = (($subtotal * $order_fee)/100);
        }
        $is_apply_additional_fee  = $this->helperData->getGeneralConfig('apply_additional_fee');
        if(!empty($is_apply_additional_fee) && !empty($order_fee)){
            return [
                'code' => 'extrafee',
                'title' => 'Order Processing Fee',
                'value' => $order_fee
            ];
        } else {
            return array();
        }
    }

    public function getLabel()
    {
        return __('Order Processing Fee');
    }
}