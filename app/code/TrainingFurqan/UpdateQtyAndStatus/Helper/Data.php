<?php


namespace TrainingFurqan\UpdateQtyAndStatus\Helper;



use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_product;

    /**
     * @var Magento\CatalogInventory\Api\StockStateInterface
     */
    protected $_stockStateInterface;

    /**
     * @var Magento\CatalogInventory\Api\StockRegistryInterface
     */
    protected $_stockRegistry;

    /**
     * @param Magento\Framework\App\Helper\Context $context
     * @param Magento\Catalog\Model\Product $product
     * @param Magento\CatalogInventory\Api\StockStateInterface $stockStateInterface,
     * @param Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Catalog\Model\Product $product,
        \Magento\CatalogInventory\Api\StockStateInterface $stockStateInterface,
        \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry
    ) {
        $this->_product = $product;
        $this->_stockStateInterface = $stockStateInterface;
        $this->_stockRegistry = $stockRegistry;
        parent::__construct($context);
    }

/**
 * For Update stock of product
 * @param int $productId which stock you want to update
 * @param array $stockData your updated data
 * @return void
 */
public function updateProductStock($productId, $stockData) {
    $product=$this->_product->load($productId); //load product which you want to update stock

    $stockItem=$this->_stockRegistry->getStockItem($item['product_id']); // load stock of that product
    $stockItem->setData('is_in_stock',$stockData['is_in_stock']); //set updated data as your requirement
    $stockItem->setData('qty',$stockData['qty']); //set updated quantity
    $stockItem->setData('manage_stock',$stockData['manage_stock']);
    $stockItem->setData('use_config_notify_stock_qty',1);
    $stockItem->save(); //save stock of item
    $product->save(); //  also save product
}
}