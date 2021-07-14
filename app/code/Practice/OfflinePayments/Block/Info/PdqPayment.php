<?php


namespace Practice\OfflinePayments\Block\Info;


class PdqPayment extends \Magento\Payment\Block\Info
{
    /**
     * @var string
     */
    protected $_template = 'Practice_OfflinePayments::info/pdqpayment.phtml';

    /**
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('Practice_OfflinePayments::info/pdf/pdqpayment.phtml');
        return $this->toHtml();
    }
}