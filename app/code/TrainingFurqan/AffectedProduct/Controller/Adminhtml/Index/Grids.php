<?php
namespace TrainingFurqan\AffectedProduct\Controller\Adminhtml\Index;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
class Grids extends \Magento\Backend\App\Action
{
   
    protected $resultRawFactory;
  
    protected $layoutFactory;

    /**
     * Grids constructor.
     * @param Context $context
     * @param RawFactory $resultRawFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        Rawfactory $resultRawFactory,
        LayoutFactory $layoutFactory
    ) {
        parent::__construct($context);
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
    }
 
    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents(
            $this->layoutFactory->create()->createBlock(
                'TrainingFurqan\AffectedProduct\Block\Adminhtml\Tab\Productgrid',
                'affectedproduct.custom.tab.productgrid'
            )->toHtml()
        );
    }
}
