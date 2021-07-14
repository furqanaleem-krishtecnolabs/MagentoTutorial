<?php


namespace Practice\BlockExample\Block;



use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\View\Element\Template;

class StockUpdate extends Template
{
    private $registry;
    private $stockRegistry;
    public function __construct(Template\Context $context,
                                \Magento\Framework\Registry $registry,
                                StockRegistryInterface $stockRegistry,
                                array $data = [])
    {
        $this->registry=$registry;
        $this->stockRegistry=$stockRegistry;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getRemainingQty(){
        $product=$this->getCurrentProduct();
        $stock=$this->stockRegistry->getStockItem($product->getId());
        return $stock->getIsInStock();
    }

    public function getCurrentProduct(){
        return $this->registry->registry('product');
    }
}