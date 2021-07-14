<?php


namespace Practice\CustomerChatBox\Block;


use Magento\Framework\View\Element\Template;

class FacebookMessenger extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Locale\ResolverInterface
     */
    protected $_localeResolver;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Locale\ResolverInterface $localeResolver
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Locale\ResolverInterface $localeResolver
    ) {
        $this->_localeResolver = $localeResolver;
        parent::__construct($context);
    }

    public function getLocate(){
        return $this->_localeResolver->getLocale();
    }
}