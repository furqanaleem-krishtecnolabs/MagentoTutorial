<?php


namespace TrainingFurqan\AdditionalFee\Block\Sales\Order;


use Magento\Quote\Api\CartRepositoryInterface;


class OrderFee extends \Magento\Framework\View\Element\Template
{

    protected $_config;
    protected $_order;
    protected $_source;
    protected $quoteRepository;

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

    public function initTotals()
    {

        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();

        $store = $this->getStore();

        /*   $order_fee_prec =  $this->helperData->getGeneralConfig('order_processing_fee');
          $subtotal = $this->_order->getSubTotal();
          if(!empty($subtotal) && !empty($order_fee_prec)){
              $order_fee_price = (($subtotal * $order_fee_prec)/100);
          } */
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