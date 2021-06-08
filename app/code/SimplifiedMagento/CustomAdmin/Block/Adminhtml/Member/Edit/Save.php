<?php


namespace SimplifiedMagento\CustomAdmin\Block\Adminhtml\Member\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Save implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'=>__('Save'),
            'class'=>'save primary',
            'sort_order'=>50
        ];
    }
}