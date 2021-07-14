<?php


namespace Practice\CustomerCondition\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerConditionObserver implements ObserverInterface
{

    /**
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        $additional = $observer->getAdditional();
        $conditions = (array) $additional->getConditions();
        $conditions = array_merge_recursive($conditions, [
            [
                'value'=> [
                    [
                        'value' => \Practice\CustomerCondition\Model\Rule\Condition\Customer\Gender::class,
                        'label' => __('Gender')
                    ]
                ],
                'label'=> __('Customer Condition')
            ]
        ]);
        $additional->setConditions($conditions);
        return $this;
    }
}