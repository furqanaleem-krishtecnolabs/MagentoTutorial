<?php


namespace TrainingFurqan\ProductDailyDeal\Block\Product;


class Display extends \Magento\Catalog\Block\Product\View
{

    public function isCountdownEnabled()
    {
        return $this->getProduct()->getData('deal_status');
    }
    public function getTile()
    {
        return $this->_scopeConfig->getValue('countdown/general/title');
    }

    public function getCountdownEndDate(){
        return  $this->getProduct()->getData('deal_time');
    }

    public function getPriceCountDown(){
        if($this->getProduct()->getData('deal_status')){
            $currentDate =  date('d-m-Y h:i:s');
            $todate      =  $this->getProduct()->getData('deal_time');
            if($this->getProduct()->getData('deal_time') != null) {
                if(strtotime($todate) >= strtotime($currentDate)){
                    return true;
                }
            }
        }
        return false;
    }


}