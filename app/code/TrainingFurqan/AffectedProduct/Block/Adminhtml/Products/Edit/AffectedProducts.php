<?php
namespace TrainingFurqan\AffectedProduct\Block\Adminhtml\Products\Edit;

class AffectedProducts extends \Magento\Backend\Block\Template
{

    protected $_template = 'products/affected_products.phtml';
    protected $blockGrid;
    protected $registry;
    protected $jsonEncoder;
    protected $productFactory;

    /**
     * AffectedProducts constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productFactory,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }
   
    public function getBlockGrid()
    {
        if (null === $this->blockGrid) {
            $this->blockGrid = $this->getLayout()->createBlock(
                'TrainingFurqan\AffectedProduct\Block\Adminhtml\Tab\Productgrid',
                'category.product.grid'
            );
        }
        return $this->blockGrid;
    }
 
    public function getGridHtml()
    {
        return $this->getBlockGrid()->toHtml();
    }
  
    public function getProductsJson()
    {
        $entity_id = $this->getRequest()->getParam('entity_id');
        $productFactory = $this->productFactory->create();
        $productFactory->addFieldToSelect(['product_id', 'position']);
        $productFactory->addFieldToFilter('entity_id', ['eq' => $entity_id]);
        $result = [];
        if (!empty($productFactory->getData())) {
            foreach ($productFactory->getData() as $rhProducts) {
                $result[$rhProducts['product_id']] = '';
            }
            return $this->jsonEncoder->encode($result);
        }
        return '{}';
    }
    public function getItem()
    {
        return $this->registry->registry('my_item');
    }
}

?>