<?php


namespace Practice\BestsellersProducts\Model\ResourceModel\Product;


class Collection extends \Magento\Catalog\Model\ResourceModel\Product\Collection
{
    /**
     * Join sales_bestsellers_aggregated_yearly relation table to retrieve the bestseller products
     *
     * @param int $storeId
     * @return $this
     */
    public function getBestsellersProduct($storeId)
    {
        $this->getSelect()->join(
            ['bestseller' => $this->getTable('sales_bestsellers_aggregated_yearly')],
            'e.entity_id = bestseller.product_id',
            ['SUM(bestseller.qty_ordered) as qty_ordered']
        )->where('bestseller.store_id = ?', (int)$storeId)->group('bestseller.product_id')->order('qty_ordered DESC');

        //$this->printLogQuery(false, true);
        return $this;
    }
}