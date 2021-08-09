<?php


namespace Practice\BioData\Block;


Class ListBioData extends \Magento\Framework\View\Element\Template
{
    protected $bioDataFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Practice\BioData\Model\BioDataFactory $bioDataFactory
    ){
        parent::__construct($context);
        $this->bioDataFactory = $bioDataFactory;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getLisBioData()
    {
        $page = ($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
        $limit = ($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 2;

        $collection = $this->bioDataFactory->create()->getCollection();
        $collection->addFieldToFilter('status',1);
        $collection->setPageSize($limit);
        $collection->setCurPage($page);

        return $collection;
    }

    protected function _prepareLayout(){
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Latest BioData'));

        if ($this->getListNews()){
            $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager', 'practice.biodata.pager')
                ->setAvailableLimit(array(2=>2,10=>10,15=>15,20=>20))
                ->setShowPerPage(true)
                ->setCollection($this->getLisBioData());

            $this->setChild('pager', $pager);

            $this->getLisBioData()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}