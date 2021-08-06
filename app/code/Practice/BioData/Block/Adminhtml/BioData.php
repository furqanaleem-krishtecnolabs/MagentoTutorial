<?php


namespace Practice\BioData\Block\Adminhtml;


class BioData extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_biodata';
        $this->_blockGroup = 'Practice_BioData';
        $this->_headerText = __('Manage Biodata');

        parent::_construct();

        if ($this->_isAllowedAction('Practice_BioData::save')) {
            $this->buttonList->update('add', 'label', __('Add Biodata'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}