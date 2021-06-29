<?php


namespace TrainingFurqan\Bike\Controller\Adminhtml\Bike\Image;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Upload extends \Magento\Backend\App\Action
{

    /**
     * Image uploader
     * @var \Magento\Catalog\Model\ImageUploader
     */
    protected $imageUploader;
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;
    /**
     * @var \Magento\Framework\Filesystem\Io\File
     */
    protected $fileIo;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Upload constructor.
     * @param \Magento\Backend\App\Action\Context        $context
     * @param \Magento\Catalog\Model\ImageUploader       $imageUploader
     * @param \Magento\Framework\Filesystem              $filesystem
     * @param \Magento\Framework\Filesystem\Io\File      $fileIo
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ImageUploader $imageUploader,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Filesystem\Io\File $fileIo,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
        $this->filesystem = $filesystem;
        $this->fileIo = $fileIo;
        $this->storeManager = $storeManager;
    }

    /**
     * Upload file controller action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */

    public function execute()
    {
        $imageUploadId = $this->getRequest()->getParam('param_name', 'image');
        try {
            $imageResult = $this->imageUploader->saveFileToTmpDir($imageUploadId);
            // Upload image folder wise
            $imageName = $imageResult['name'];
            $firstName = substr($imageName, 0, 1);
            $secondName = substr($imageName, 1, 1);
            $basePath = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath() . 'bike_image/';
            $mediaRootDir = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath() . 'bike_image/';
            if (!is_dir($mediaRootDir)) {
                $this->fileIo->mkdir($mediaRootDir, 0775);
            }
            // Set image name with new name, If image already exist
            $newImageName = $this->updateImageName($mediaRootDir, $imageName);
            $this->fileIo->mv($basePath . $imageName, $mediaRootDir . $newImageName);
            // Upload image folder wise
            $imageResult['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $imageResult['name'] = $newImageName;
            $imageResult['file'] = $newImageName;
            $imageResult['url'] = $mediaUrl . 'bike_image/'. $newImageName;
        } catch (\Exception $e) {
            $imageResult = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($imageResult);
    }

    public function updateImageName($path, $file_name)
    {
        if ($position = strrpos($file_name, '.')) {
            $name = substr($file_name, 0, $position);
            $extension = substr($file_name, $position);
        } else {
            $name = $file_name;
        }
        $new_file_path = $path . '/' . $file_name;
        $new_file_name = $file_name;
        $count = 0;
        while (file_exists($new_file_path)) {
            $new_file_name = $name . '_' . $count . $extension;
            $new_file_path = $path . '/' . $new_file_name;
            $count++;
        }
        return $new_file_name;
    }
}