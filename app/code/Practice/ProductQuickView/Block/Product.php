<?php


namespace Practice\ProductQuickView\Block;


class Product extends \Magento\Catalog\Block\Product\AbstractProduct
{
    /**
     * @var \Practice\ProductQuickView\Helper\Data
     */
    protected $helperData;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Practice\ProductQuickView\Helper\Data $helperData
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Practice\ProductQuickView\Helper\Data $helperData,
        array $data = []
    ) {
        $this->helperData = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * Display the quick view content
     *
     * @return boolean
     */
    public function displayQuickView()
    {
        if ($this->helperData->productQuickViewEnabled()) {
            return true;
        }
        return false;
    }
}