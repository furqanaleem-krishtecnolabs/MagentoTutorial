<?php


namespace Practice\ProductQuickView\Helper;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_QUICKVIEW_ENABLED = 'catalog/product_quick_view/enable';

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Retrieve the enable quick view
     *
     * @return boolean
     */
    public function productQuickViewEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_QUICKVIEW_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}