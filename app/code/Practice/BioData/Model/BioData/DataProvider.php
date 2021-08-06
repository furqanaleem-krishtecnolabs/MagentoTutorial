<?php


namespace Practice\BioData\Model\BioData;

use Practice\BioData\Model\ResourceModel\BioData\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Practice\BioData\Model\ResourceModel\BioData\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $bioDataCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $bioDataCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $bioDataCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta=$this->prepareMeta($this->meta);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        /** @var \Practice\BioData\Model\BioData $bioData */
        foreach ($items as $bioData) {
            $this->loadedData[$bioData->getId()] = $bioData->getData();
        }

        // Used from the Save action
        $data = $this->dataPersistor->get('biodata_info');
        if (!empty($data)) {
            $bioData = $this->collection->getNewEmptyItem();
            $bioData->setData($data);
            $this->loadedData[$bioData->getId()] = $bioData->getData();
            $this->dataPersistor->clear('biodata_info');
        }

        return $this->loadedData;
    }
    public function prepareMeta(array $meta){
        return $meta;
    }
}