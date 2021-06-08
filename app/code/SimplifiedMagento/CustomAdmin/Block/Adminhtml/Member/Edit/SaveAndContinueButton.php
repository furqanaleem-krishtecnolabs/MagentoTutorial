<?php


namespace SimplifiedMagento\CustomAdmin\Block\Adminhtml\Member\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndContinueButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save And Continue'),
            'class' => 'save',
            'sort_order'=>40
        ];
    }
}