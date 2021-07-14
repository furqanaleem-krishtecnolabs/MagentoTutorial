<?php


namespace Practice\CustomerChatBox\Helper;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
//    const FACEBOOK_MESSANGER_ENABLE='customer_chatbox/general/facebook_messenger_enable';
//    const FACEBOOK_MESSANGER_CUSTOMER_CHAT_CODE='customer_chatbox/general/facebook_messenger_customer_chat_code';
    const TAWK_TO_WIDGET_ENABLE = 'phpcuong_customer_chatbox/general/tawk_enable';
    const TAWK_TO_WIDGET_CODE = 'phpcuong_customer_chatbox/general/tawk_widget_code';

    /**
     * @return bool
     */
//    public function getFacebookMessangerStatus(){
//        return $this->scopeConfig->isSetFlag(
//            self::FACEBOOK_MESSANGER_ENABLE,
//            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
//        );
//    }
//
//    /**
//     * @return string
//     */
//    public function getFaceBookMessangerChatCode(){
//        return $this->scopeConfig->getValue(
//            self::FACEBOOK_MESSANGER_CUSTOMER_CHAT_CODE,
//            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
//        );
//    }

    /**
     * @return bool
     */
    public function getTawkToWidgetStatus(){
        return $this->scopeConfig->isSetFlag(
            self::TAWK_TO_WIDGET_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getTawkToWidgetCode(){
        return $this->scopeConfig->getValue(
            self::TAWK_TO_WIDGET_CODE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}