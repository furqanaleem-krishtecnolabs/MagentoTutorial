<?php


namespace SimplifiedMagento\BioData\Model;


use SimplifiedMagento\BioData\Model\ResourceModel\BioData\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Store\Model\StoreManagerInterface;


class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $biodataCollectionFactory
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
        CollectionFactory $biodataCollectionFactory,
        RequestInterface $request,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $biodataCollectionFactory->create();
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
        // $this->collection->setBiodataId($storeId)->addAttributeToSelect('*');
        $items = $this->collection->getItems();
        $this->loadedData = array();
        foreach ($items as $item) {
            $item->setBiodataId($storeId);
            $itemData = $item->getData();
            if (isset($itemData['candidate_image'])) {
                $imageName = explode('/', $itemData['candidate_image']);
                $itemData['candidate_image'] = [
                    [
                        'name' => $imageName[0],
                        'url' => $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'biodata_image/' . $itemData['candidate_image'],
                    ],
                ];
            } else {
                $itemData['candidate_image'] = null;
            }
            $this->loadedData[$item->getBiodataId()]= $itemData;
            // break;
        }
        return $this->loadedData;

    }
}