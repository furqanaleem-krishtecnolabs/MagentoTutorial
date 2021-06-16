<?php


namespace TrainingFurqan\Bike\Model;

use TrainingFurqan\Bike\Model\ResourceModel\Bike\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreManagerInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $bikeCollectionFactory
     * @param array $meta
     * @param array $data
     */
    protected $loadedData;

    protected $request;

    protected $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $bikeCollectionFactory,
        RequestInterface $request,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $bikeCollectionFactory->create();
        $this->request = $request;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
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

        $storeId = (int) $this->request->getParam('id');
        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $item) {
            $item->setBikeId($storeId);
            $itemData = $item->getData();
            if (isset($itemData['image'])) {
                $imageName = explode('/', $itemData['image']);
                $itemData['image'] = [
                    [
                        'name' => $imageName[0],
                        'url' => $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'bike_image/' . $itemData['image'],
                    ],
                ];
            } else {
                $itemData['image'] = null;
            }
            $this->loadedData[$item->getBikeId()]= $itemData;
            // break;
        }
        return $this->loadedData;

    }
}