<?php


namespace TrainingFurqan\Bike\Controller\Adminhtml\Bike;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \TrainingFurqan\Bike\Model\BikeFactory
     */
    var $bikeFactory;
    var $_fileUploaderFactory;
    var $_filesystem;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \TrainingFurqan\Bike\Model\BikeFactory $bikeFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \TrainingFurqan\Bike\Model\BikeFactory $bikeFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->bikeFactory = $bikeFactory;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('bike/bike/addrow');
            return;
        }
        try {
            $rowData = $this->bikeFactory->create();

            /* for upload image */
            /* $uploader = $this->_fileUploaderFactory->create(['fileId' => 'candidate_image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);
            $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('car_image/');
            $uploader->save($path);
            if(isset($_FILES['candidate_image']['name']) && !empty($_FILES['candidate_image']['name'])){
                $data['candidate_image'] = $_FILES['candidate_image']['name'];
            } */
            if(is_array($data['extra_feature']) && !empty($data['extra_feature'])){
                $data['extra_feature'] = implode(',',$data['extra_feature']);
            }
            if(is_array($data['country']) && !empty($data['country'])){
                $data['country'] = implode(',',$data['country']);
            }
            if(!empty($data['image']))$data['image'] = $data['image'][0]['name'] ;
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setBikeId($data['id']);
            }
            $rowData->save();

            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('bike/bike/index');
    }
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingFurqan_Bike::save');
    }

}