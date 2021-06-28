<?php


namespace TrainingFurqan\AdditionalFee\Block\Adminhtml\Sales\Order\Invoice;


use Magento\Quote\Api\CartRepositoryInterface;

class Totals extends \Magento\Framework\View\Element\Template
{

    protected $_dataHelper;
    protected $_invoice = null;
    protected $_source;
    protected $quoteRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \TrainingFurqan\AdditionalFee\Helper\Data $dataHelper,
        CartRepositoryInterface $quoteRepository,
        array $data = []
    ) {
        $this->_dataHelper = $dataHelper;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($context, $data);
    }

    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    public function getInvoice()
    {
        return $this->getParentBlock()->getInvoice();
    }

    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    public function initTotals()
    {
        $this->getParentBlock();
        $this->getInvoice();
        $this->getSource();
        $this->getOrder();

        $order_fee_prec =  $this->_dataHelper->getGeneralConfig('order_processing_fee');
        $quoteId = $this->getOrder()->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $order_fee_price = $quote->getExtrafee();

        if(!$order_fee_price) {
            return $this;
        }
        // $subtotal = $this->getInvoice()->getSubTotal();
        /* if(!empty($subtotal) && !empty($order_fee_prec)){
            $order_fee_price = (($subtotal * $order_fee_prec)/100);
        } */
        $total = new \Magento\Framework\DataObject(
            [
                'code' => 'extrafee',
                'value' => $order_fee_price,
                'label' => __('Order Processing Fee'),
            ]
        );

        $this->getParentBlock()->addTotalBefore($total, 'grand_total');
        return $this;
    }
}