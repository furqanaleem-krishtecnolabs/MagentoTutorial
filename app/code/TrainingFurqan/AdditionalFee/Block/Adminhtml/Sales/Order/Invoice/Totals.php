<?php


namespace TrainingFurqan\AdditionalFee\Block\Adminhtml\Sales\Order\Invoice;


use Magento\Quote\Api\CartRepositoryInterface;

class Totals extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \TrainingFurqan\AdditionalFee\Helper\Data
     */
    protected $_dataHelper;
    protected $_invoice = null;
    protected $_source;
    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Totals constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \TrainingFurqan\AdditionalFee\Helper\Data $dataHelper
     * @param CartRepositoryInterface $quoteRepository
     * @param array $data
     */
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

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
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