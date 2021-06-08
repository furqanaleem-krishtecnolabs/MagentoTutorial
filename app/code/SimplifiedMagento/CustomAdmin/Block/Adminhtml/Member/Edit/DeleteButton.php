<?php


namespace SimplifiedMagento\CustomAdmin\Block\Adminhtml\Member\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends Generic implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        $data=[];
        if($this->getId()){
            $data=[
                'label' =>__('Delete Button'),
                'on_click' => 'deleteConfirm(\''.__('Are U sure to delete?')
                .'\',\''.
                $this->getDeleteUrl().'\')' ,
                'class' => 'delete',
                'sort_order' =>20
            ];
        }
        return $data;
    }
    public function getDeleteUrl(){
        return $this->getUrl('*/*/delete',['id'=>$this->getId()]);
    }

}