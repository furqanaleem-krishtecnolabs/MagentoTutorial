<?php


namespace TrainingFurqan\AdditionalFee\Block\Adminhtml\Sales;


use Magento\Quote\Api\CartRepositoryInterface;

class Totals extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \TrainingFurqan\AdditionalFee\Helper\Data
     */
    protected $_dataHelper;
    /**
     * @var \Magento\Directory\Model\Currency
     */
    protected $_currency;
    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * Totals constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \TrainingFurqan\AdditionalFee\Helper\Data $dataHelper
     * @param \Magento\Directory\Model\Currency $currency
     * @param CartRepositoryInterface $quoteRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \TrainingFurqan\AdditionalFee\Helper\Data $dataHelper,
        \Magento\Directory\Model\Currency $currency,
        CartRepositoryInterface $quoteRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_dataHelper = $dataHelper;
        $this->_currency = $currency;
        $this->quoteRepository = $quoteRepository;
    }

    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }


    public function getCurrencySymbol()
    {
        return $this->_currency->getCurrencySymbol();
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function initTotals()
    {
        $order_fee_prec =  $this->_dataHelper->getGeneralConfig('order_processing_fee');

        $this->getParentBlock();
        $this->getOrder();
        $this->getSource();


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