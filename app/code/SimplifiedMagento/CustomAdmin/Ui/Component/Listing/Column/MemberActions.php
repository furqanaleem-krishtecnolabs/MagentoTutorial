<?php


namespace SimplifiedMagento\CustomAdmin\Ui\Component\Listing\Column;


use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class MemberActions extends Column
{
    protected $url;
    public function __construct(ContextInterface $context,
                                UiComponentFactory $uiComponentFactory,
                                array $components = [], array $data = [],
UrlInterface $url)
    {
        $this->url=$url;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){}
        foreach ($dataSource['data']['items'] as &$item){
            $item[$this->getData('name')]['edit']=['href'=>$this->url->getUrl('affiliate/member/edit',['id'=>$item['entity_id']]),
            'label' => __('Edit'),
            'hidden'=>false
            ];
            $item[$this->getData('name')]['delete']=['href'=>$this->url->getUrl('affiliate/member/delete',['id'=>$item['entity_id']]),
                'label'=>__('Delete'),
                'hidden'=>false
            ];
        }
        return parent::prepareDataSource($dataSource);
    }
}