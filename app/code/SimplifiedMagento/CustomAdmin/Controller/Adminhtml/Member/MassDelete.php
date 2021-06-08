<?php


namespace SimplifiedMagento\CustomAdmin\Controller\Adminhtml\Member;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Data\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected $filter;
    protected $collectionFactory;
    protected $redirectFactory;
    public function __construct(Context $context,
    Filter $filter,
    CollectionFactory $collectionFactory,
    RedirectFactory $redirectFactory
)
    {
        $this->redirectFactory=$redirectFactory;
        $this->filter=$filter;
        $this->collectionFactory=$collectionFactory;
        parent::__construct($context);
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $collection=$this->filter->getCollection($this->collectionFactory->create());

        foreach ($collection as $item){
            $item->delete();
        }
        $size=$collection->getSize();
        $this->messageManager->addSuccessMessage(__('A total of' .$size.'have been deleted'));
        $resultRedirect=$this->redirectFactory->create();

        return $resultRedirect->setPath('*/*/index');

    }
}