<?php


namespace Practice\PriceDecimal\Plugin\Sales\Model;


class Order
{
    /**
     * @var \Practice\PriceDecimal\Helper\Data
     */
    protected $priceDecimalHelperData;

    /**
     * @param \Practice\PriceDecimal\Helper\Data $priceDecimalHelperData
     */
    public function __construct(
        \Practice\PriceDecimal\Helper\Data $priceDecimalHelperData
    ) {
        $this->priceDecimalHelperData = $priceDecimalHelperData;
    }

    /**
     * @param \Magento\Sales\Model\Order $subject
     * @param array ...$args
     * @return array
     */
    public function beforeFormatPricePrecision(
        \Magento\Sales\Model\Order $subject,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                //change the precision
                $args[1] = $this->priceDecimalHelperData->getDecimalLength();
            } else {
                $args[1] = 0;
            }
        }
        return $args;
    }
}