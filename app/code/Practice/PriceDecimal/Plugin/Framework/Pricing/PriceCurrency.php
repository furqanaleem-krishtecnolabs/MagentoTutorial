<?php


namespace Practice\PriceDecimal\Plugin\Framework\Pricing;


class PriceCurrency
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
     * {@inheritdoc}
     */
    public function beforeFormat(
        \Magento\Directory\Model\PriceCurrency $subject,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                // add the optional arg
                if (!isset($args[1])) {
                    $args[1] = true;
                }
                // Precision argument
                $args[2] = $this->priceDecimalHelperData->getDecimalLength();
            } else {
                // Precision argument
                $args[2] = 0;
            }
        }
        return $args;
    }

    /**
     * @param \Magento\Directory\Model\PriceCurrency $subject
     * @param callable $proceed
     * @param $price
     * @param array ...$args
     * @return float
     */
    public function aroundRound(
        \Magento\Directory\Model\PriceCurrency $subject,
        callable $proceed,
        $price,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                return round($price, $this->priceDecimalHelperData->getDecimalLength());
            } else {
                return round($price, 0);
            }
        }

        return $proceed($price);
    }

    /**
     * @param \Magento\Directory\Model\PriceCurrency $subject
     * @param array ...$args
     * @return array
     */
    public function beforeConvertAndFormat(
        \Magento\Directory\Model\PriceCurrency $subject,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                // add the optional args
                $args[1] = isset($args[1])? $args[1] : null;
                $args[2] = $this->priceDecimalHelperData->getDecimalLength();
            } else {
                $args[2] = 0;
            }
        }
        return $args;
    }

    /**
     * @param \Magento\Directory\Model\PriceCurrency $subject
     * @param array ...$args
     * @return array
     */
    public function beforeConvertAndRound(
        \Magento\Directory\Model\PriceCurrency $subject,
        ...$args
    ) {
        if ($this->priceDecimalHelperData->isEnable()) {
            if ($this->priceDecimalHelperData->showDecimal()) {
                //add optional args
                $args[1] = isset($args[1])? $args[1] : null;
                $args[2] = isset($args[2])? $args[2] : null;
                $args[3] = $this->priceDecimalHelperData->getDecimalLength();
            } else {
                //add optional args
                $args[1] = isset($args[1])? $args[1] : null;
                $args[2] = isset($args[2])? $args[2] : null;
                $args[3] = 0;
            }
        }

        return $args;
    }
}