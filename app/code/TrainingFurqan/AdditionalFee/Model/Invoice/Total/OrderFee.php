<?php


namespace TrainingFurqan\AdditionalFee\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;
use Magento\Quote\Api\CartRepositoryInterface;

class OrderFee extends AbstractTotal
{
    protected $quoteRepository;

    public function __construct(
        CartRepositoryInterface $quoteRepository

    ) {
        $this->quoteRepository = $quoteRepository;
    }

    public function collect(\Magento\Sales\Model\Order\Invoice $invoice)
    {

        $quoteId =  $invoice->getOrder()->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $amount = $quote->getExtrafee();

        $invoice->setGrandTotal($invoice->getGrandTotal() + $amount);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $amount);

        return $this;
    }
}