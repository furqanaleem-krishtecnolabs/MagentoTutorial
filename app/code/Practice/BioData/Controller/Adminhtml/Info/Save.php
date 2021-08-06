<?php


namespace Practice\BioData\Controller\Adminhtml\Info;


use Magento\Backend\App\Action;
use Practice\BioData\Model\BioData;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Practice\BioData\Model\BioDataFactory
     */
    private $bioDtaFactory;

    /**
     * @var \Practice\BioData\Api\BioDataRepositoryInterface
     */
    private $bioDtaRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Practice\BioData\Model\BioDataFactory $bioDtaFactory
     * @param \Practice\BioData\Api\BioDataRepositoryInterface $bioDtaRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Practice\BioData\Model\BioDataFactory $bioDtaFactory = null,
        \Practice\BioData\Api\BioDataRepositoryInterface $bioDtaRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->bioDtaFactory = $bioDtaFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Practice\BioData\Model\BioDataFactory::class);
        $this->bioDtaRepository = $bioDtaRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Practice\BioData\Api\BioDataRepositoryInterface::class);
        parent::__construct($context);
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
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = BioData::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            /** @var \Practice\BioData\Model\BioData $model */
            $model = $this->bioDtaFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->bioDtaRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This news no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'biodata_info_prepare_save',
                ['info' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->bioDataRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the news.'));
                $this->dataPersistor->clear('biodata_info');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the bio data.'));
            }

            $this->dataPersistor->set('biodata_info', $data);
            return $resultRedirect->setPath('*/*/edit', ['news_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
