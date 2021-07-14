<?php


namespace Practice\BlockExample\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Product implements ObserverInterface
{

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $collection=$observer->getEvent()->getData('collection');
        foreach ($collection as $product){
            $price=$product->getData('price');
            $name=$product->getData('name');
            if($price<60){
                $name.='so cheap';
            }else{
                $name.='so bloody expensive';
            }
            $product->setData('name',$name);

        }

    }
}