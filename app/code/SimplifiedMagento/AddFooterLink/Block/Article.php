<?php


namespace SimplifiedMagento\AddFooterLink\Block;


use Magento\Framework\View\Element\Template;

class Article extends Template
{
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }
    public function getArticles(){
        return 'getArticles function of block class called successfully';
    }

}