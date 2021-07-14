<?php


namespace Practice\BannerSlider\Model\ResourceModel;


class Group extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('banners_slider_group', 'id');
    }
}