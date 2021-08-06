<?php


namespace Practice\BioData\Block;

Class LinkBioData extends \Magento\Framework\View\Element\Template
{
    protected $dataHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Practice\BioData\Helper\Data $dataHelper
    ){
        parent::__construct($context);
        $this->dataHelper = $dataHelper;
    }

    public function getNewsLink()
    {
        $newsLink = $this->dataHelper->getStorefrontConfig('bio_link');

        return $newsLink;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
}