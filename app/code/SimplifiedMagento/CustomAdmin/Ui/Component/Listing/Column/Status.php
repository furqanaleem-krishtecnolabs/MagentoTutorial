<?php


namespace SimplifiedMagento\CustomAdmin\Ui\Component\Listing\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Status extends Column
{
    Public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['item'])){
            foreach($dataSource['data']['items'] as &$item){
                if($item['status']==1){
                    $item['status']='yes';
                }else{
                    $item['status']='No';
                }

            }
        }

        return parent::prepareDataSource($dataSource); // TODO: Change the autogenerated stub
    }
}