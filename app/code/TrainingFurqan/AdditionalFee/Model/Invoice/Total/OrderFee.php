<?php


namespace TrainingFurqan\AdditionalFee\Model\Invoice\Total;

use Magento\Sales\Model\Order\Invoice\Total\AbstractTotal;
use Magento\Quote\Api\CartRepositoryInterface;

class OrderFee extends AbstractTotal
{
    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * OrderFee constructor.
     * @param CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        CartRepositoryInterface $quoteRepository

    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return $this|AbstractTotal
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
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