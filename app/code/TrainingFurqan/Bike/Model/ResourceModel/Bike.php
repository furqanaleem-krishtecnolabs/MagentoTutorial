<?php


namespace TrainingFurqan\Bike\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Stdlib\DateTime\DateTime;



/**
 * Class Bike
 * @package TrainingFurqan\Bike\Model\ResourceModel
 */
class Bike extends AbstractDb
{

    /**
     * @var string
     */
    protected $_idFieldName='bike_id';

    /**
     * @var DateTime
     */
    protected $_date;

    /**
     * Construct.
     *
     * @param Context $context
     * @param DateTime $date
     * @param string|null $resourcePrefix
     */
        public function __construct(Context $context, DateTime $date,$resourcePrefix=null){
            parent::__construct($context,$resourcePrefix);
            $this->_date=$date;
        }

    /**
     * Resource initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('bike_data','bike_id');
    }
}