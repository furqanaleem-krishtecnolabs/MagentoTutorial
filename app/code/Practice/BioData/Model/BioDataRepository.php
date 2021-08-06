<?php


namespace Practice\BioData\Model;


use Practice\BioData\Api\Data;
use Practice\BioData\Api\BioDataRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Practice\BioData\Model\ResourceModel\BioData as ResourceBioData;
use Practice\BioData\Model\ResourceModel\BioData\CollectionFactory as BioDataCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class BioDataRepository implements BioDataRepositoryInterface
{
    protected $resource;

    protected $bioDataFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataBioDataFactory;

    private $storeManager;

    public function __construct(
        ResourceBioData $resource,
        BioDataFactory $bioDataFactory,
        Data\BioDataInterfaceFactory $dataBioDataFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->bioDataFactory = $bioDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBioDataFactory = $dataBioDataFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\Practice\BioData\Api\Data\BioDataInterface $bioData)
    {
        if ($bioData->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $bioData->setStoreId($storeId);
        }
        try {
            $this->resource->save($bioData);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the news: %1', $exception->getMessage()),
                $exception
            );
        }
        return $bioData;
    }

    public function getById($Id)
    {
        $bioData = $this->bioDataFactory->create();
        $bioData->load($Id);
        if (!$bioData->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $Id));
        }
        return $bioData;
    }

    public function delete(\Practice\BioData\Api\Data\BioDataInterface $bioData)
    {
        try {
            $this->resource->delete($bioData);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the news: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($Id)
    {
        return $this->delete($this->getById($Id));
    }
}