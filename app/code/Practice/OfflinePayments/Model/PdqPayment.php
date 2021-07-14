<?php


namespace Practice\OfflinePayments\Model;

use Magento\Quote\Api\Data\PaymentInterface;
class PdqPayment extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_PDQPAYMENT_CODE = 'pdqpayment';

    /**
     * Payment method code
     *
     * @var string
     */
    protected $_code = self::PAYMENT_METHOD_PDQPAYMENT_CODE;

    /**
     * @var string
     */
    protected $_formBlockType = \Practice\OfflinePayments\Block\Form\PdqPayment::class;

    /**
     * @var string
     */
    protected $_infoBlockType = \Practice\OfflinePayments\Block\Info\PdqPayment::class;

    /**
     * Availability option
     *
     * @var bool
     */
    protected $_isOffline = true;

}