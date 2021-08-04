<?php


namespace Practice\BioData\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
class Data extends AbstractHelper
{
    const XML_PATH_PERSON_BIO='person_bio/';
    public function getConfigValue($field,$storeCode=null){
        return $this->scopeConfig->getValue($field,ScopeInterface::SCOPE_STORE,$storeCode);
    }

    public function getGeneralConfig($fieldid,$storeCode=null){
        return $this->getConfigValue(self::XML_PATH_PERSON_BIO.'general'.$fieldid,$storeCode);
    }
    public function getStoreFrontConfig($fieldid,$storeCode=null){
        return $this->getConfigValue(self::XML_PATH_PERSON_BIO.'storefront/'.$fieldid,$storeCode);
    }
}