<?php


namespace TrainingFurqan\AffectedProduct\Block\Adminhtml\Tab;

use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\Store;

class Productgrid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $coreRegistry=null;
    protected $productFactory;
    protected $productCollFactory;

    public function __construct(\Magento\Backend\Block\Template\Context $context,
                                \Magento\Backend\Helper\Data $backendHelper,
                                \Magento\Catalog\Model\ProductFactory $productFactory,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollFactory,
                                \Magento\Framework\Registry $coreRegistry,
                                \Magento\Framework\Module\Manager $moduleManager,
                                \Magento\Store\Model\StoreManagerInterface $storeManager,
                                Visibility $visibility=null,
                                array $data = [])
    {
        $this->productFactory=$productFactory;
        $this->productCollFactory=$productCollFactory;
        $this->coreRegistry = $coreRegistry;
        $this->moduleManager = $moduleManager;
        $this->_storeManager = $storeManager;
        $this->visibility=$visibility ?:ObjectManager::getInstance()->get(Visibility::class);
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('affected_grid_products');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
        if($this->getRequest()->getParam('entity_id')){
            $this->setDefaultFilter(['in_products'=>1]);
        }else{
            $this->setDefaultFilter(['in_products'=>0]);
        }
        $this->setSaveParametersInSession(true);
    }

    protected function _getStore(){
        $storeId=
    }
}