<?php


namespace SimplifiedMagento\CustomAdmin\Model\Ui;


use Magento\Ui\DataProvider\AbstractDataProvider;
use SimplifiedMagento\Database\Model\ResourceModel\AffiliatedMember\CollectionFactory;
class DataProvider extends AbstractDataProvider
{
    protected $loadedData;
    public function __construct($name, $primaryFieldName, $requestFieldName, array $meta = [], array $data = [],CollectionFactory $collectionFactory)
    {
        $this->collection=$collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)){
            return $this->loadedData;
        }
        $item=$this->collection->getItems();
        $this->loadedData=array();

        foreach ($item as $member){
            $this->loadedData[$member->getId()]['member'] =$member->getData();
        }
        return $this->loadedData;
    }
}