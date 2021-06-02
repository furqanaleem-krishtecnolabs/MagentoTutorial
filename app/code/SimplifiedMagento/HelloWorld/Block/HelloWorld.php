<?php


namespace SimplifiedMagento\HelloWorld\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;

class HelloWorld extends \Magento\Framework\View\Element\Template
{
    protected $product;
    public function __construct(
        ProductRepositoryInterface $productRepository,
        Template\Context $context, array $data = [])
    {
        $this->product=$productRepository;
        parent::__construct($context, $data);
    }

    public function getHelloWorld(){
        return 'this is from custom block';
    }
    public function helloArray(){
        $aray=[
            "good",
            "vey Good",
            "Excelent"
        ];

        return $aray;
    }
    public function getProductName(){
        $product=$this->product->get('24-MB01');
        return $product->getName();
    }


}