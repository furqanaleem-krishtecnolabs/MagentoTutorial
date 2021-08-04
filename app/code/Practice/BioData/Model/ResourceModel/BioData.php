<?php


namespace Practice\BioData\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
class BioData extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bio_data','id');
    }
}