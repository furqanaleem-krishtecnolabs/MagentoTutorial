<?php


namespace TrainingFurqan\AdditionalFee\Block\Sales\Order;


use Magento\Quote\Api\CartRepositoryInterface;


class OrderFee extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Tax\Model\Config
     */
    protected $_config;
    protected $_order;
    protected $_source;
    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * OrderFee constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Tax\Model\Config $taxConfig
     * @param \TrainingFurqan\AdditionalFee\Helper\Data $helperData
     * @param CartRepositoryInterface $quoteRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Tax\Model\Config $taxConfig,
        \TrainingFurqan\AdditionalFee\Helper\Data $helperData,
        CartRepositoryInterface $quoteRepository,
        array $data = []
    ) {
        $this->_config = $taxConfig;
        $this->helperData = $helperData;
        $this->quoteRepository = $quoteRepository;
        parent::__construct($context, $data);
    }

    public function displayFullSummary()
    {
        return true;
    }


    public function getSource()
    {
        return $this->_source;
    }
    public function getStore()
    {
        return $this->_order->getStore();
    }


    public function getOrder()
    {
        return $this->_order;
    }


    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }


    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }

    /**
     * @return $this
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function initTotals()
    {

        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();

        $store = $this->getStore();

        $quoteId = $this->_order->getQuoteId();
        $quote = $this->quoteRepository->get($quoteId);
        $order_fee_price = $quote->getExtrafee();

        if($order_fee_price === '0.00') {
            return $this;
        }

        $order_fee = new \Magento\Framework\DataObject(
            [
                'code' => 'extrafee',
                'strong' => false,
                'value' => $order_fee_price,
                //'value' => $this->_source->getFee(),
                'label' => __('Order Processing Fee'),
            ]
        );

        $parent->addTotal($order_fee, 'extrafee');
        // $this->_addTax('grand_total');
        $parent->addTotal($order_fee, 'extrafee');


        return $this;
    }

}