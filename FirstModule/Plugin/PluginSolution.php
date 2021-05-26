<?php


namespace SimplifiedMagento\FirstModule\Plugin;


class PluginSolution
{
    public function beforeExecute(
        \SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject
    )
    {
        echo "before execute sort order 10";
    }
    public function afterExecute(
        \SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject
    ){
        echo "after execute sort order 10";
    }
    public function aroundExecute(
        \SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject,callable $proceed
    ){

        echo "before proceed  sort order 10";
        $proceed();
        echo "after proceed sort order 10";
    }

//    public function beforeSetname(\Magento\Catalog\Model\Product $subject,$name){
//        return "before Plugin".$name;
//    }
//    public  function afterGetname(\Magento\Catalog\Model\Product $subject,$result){
//        return "after Plugin".$result;
//    }
//public function aroundGetName(\Magento\Catalog\Model\Product $subject,callable $proceed){
//    echo "before proceed";
//    $name=$proceed();
//    echo $name;
//    echo "after proceed";
//    return $name;



}