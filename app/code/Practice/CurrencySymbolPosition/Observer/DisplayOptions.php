<?php


namespace Practice\CurrencySymbolPosition\Observer;


class DisplayOptions implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Practice\CurrencySymbolPosition\Model\System\CurrencySymbolPositionFactory
     */
    protected $_currencySymbolPosition;

    /**
     * @param \Practice\CurrencySymbolPosition\Model\System\CurrencySymbolPositionFactory $symbolPositionSystemFactory
     */
    public function __construct(
        \Practice\CurrencySymbolPosition\Model\System\CurrencySymbolPositionFactory $symbolPositionSystemFactory
    ) {
        $this->_currencySymbolPosition = $symbolPositionSystemFactory;
    }

    /**
     * hook to event currency_display_options_forming
     * change currency symbol position
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        // Get the position value from configuration
        $positionValue = $this->_currencySymbolPosition->create()->unserializeStoreConfig();
        $baseCode = $observer->getEvent()->getBaseCode();
        $position = null;
        foreach ($positionValue as $key => $value) {
            if ($key == $baseCode) {
                $position = (int)$value;
            }
        }

        if (in_array($position, [\Magento\Framework\Currency::RIGHT, \Magento\Framework\Currency::LEFT])) {
            $currencyOptions = $observer->getEvent()->getCurrencyOptions();
            // change currency symbol position to $position
            $currencyOptions->setData('position', (int)$position);
        }

        return $this;
    }
}