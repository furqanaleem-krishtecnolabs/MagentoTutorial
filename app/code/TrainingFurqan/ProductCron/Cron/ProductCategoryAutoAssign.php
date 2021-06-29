<?php


namespace TrainingFurqan\ProductCron\Cron;

use Psr\Log\LoggerInterface;

class ProductCategoryAutoAssign
{
    protected $logger;
    protected $_productCollectionFactory;
    protected $categoryManagementRepository;
    protected $categoryLinkRepository;

    public function __construct(LoggerInterface $logger,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
                                \Magento\Catalog\Api\CategoryLinkManagementInterface  $categoryManagementRepository,
                                \Magento\Catalog\Api\CategoryLinkRepositoryInterface  $categoryLinkRepository
    ) {
        $this->logger = $logger;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->categoryManagementRepository = $categoryManagementRepository;
        $this->categoryLinkRepository = $categoryLinkRepository;
    }

    public function execute() {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        $to = date("Y-m-d h:i:s"); // current date
        $from = strtotime('-3 day', strtotime($to));
        $from = date('Y-m-d h:i:s', $from); // 3 days before

        $collection->addFieldToFilter('created_at', array('from'=>$from, 'to'=>$to));
        $collection->addAttributeToSort('entity_id', 'DESC');
        $items = $collection->getItems();
        $itemCount = $collection->count();

        if($itemCount > 0){
            $prd_count = 0;
            foreach($items as $item){
                $prd_sku_dta = $item->getSKU();
                $categoryIds = array('41');
                $this->categoryManagementRepository->assignProductToCategories($prd_sku_dta, $categoryIds);

                $prd_count++;
                if($prd_count > 10){ //if count is greater tha 10 the category will get remove from older products
                    $cat_id = "41";
                    $this->categoryLinkRepository->deleteByIds($cat_id, $prd_sku_dta);
                }
                //$this->logger->info($prd_data);
            }
        }

        if($itemCount > 10){ //remove category from older products if existing product for this cat is greater than 10.
            $ids = [41];
            $collection = $this->_productCollectionFactory->create();
            $collection->addAttributeToSelect('*');
            $collection->addCategoriesFilter(['in' => $ids]);
            $collection->addFieldToFilter('created_at', array('lt'=>$from));
            $cat_prd_items = $collection->getItems();
            $cat_prd_itemCount = $collection->count();

            if($cat_prd_itemCount > 0){
                foreach($cat_prd_items as $item){
                    $prd_sku_dta = $item->getSKU();
                    $cat_id = "41";
                    $this->categoryLinkRepository->deleteByIds($cat_id, $prd_sku_dta);
                }
            }
        }

    }
}