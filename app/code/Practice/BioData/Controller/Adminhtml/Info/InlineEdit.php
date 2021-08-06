<?php


namespace Practice\BioData\Controller\Adminhtml\Info;


use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Practice\BioData\Api\BioDataRepositoryInterface as BioDataRepository;
use Practice\BioData\Api\Data\BioDataInterface;
class InlineEdit extends \Magento\Backend\App\Action
{
    protected $bioDataRepository;

    /** @var JsonFactory  */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        BioDataRepository $bioDataRepository,
        JsonFactory $jsonFactory
    ) {
        $this->bioDataRepository=$bioDataRepository;
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }
    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Practice_BioData::save');
    }
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $Id) {
                    /** @var \Practice\BioData\Model\BioData $model */
                    $model = $this->_objectManager->create('Practice\BioData\Model\BioData');
                    $model->load($Id);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$Id]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = $this->getErrorWithBannerId(
                            $model,
                            __($e->getMessage())
                        );
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add banner name to error message
     *
     * @param \Practice\BioData\Model\BioData $bioData
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithId(\Practice\BioData\Model\BioData $bioData, $errorText)
    {
        return '[ID: ' . $bioData->getId() . '] ' . $errorText;
    }
    public function setBioData(\Practice\BioData\Model\BioData $bioData,array $extendedBioData,array $bioDataData){
        $bioData->setData(array_merge($bioData->getData(),$extendedBioData,$bioDataData));
        return $this;
    }

}