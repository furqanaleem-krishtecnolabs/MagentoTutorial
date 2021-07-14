<?php


namespace Practice\BlockExample\Plugins;


class Product
{

    public function aftergetName(\Magento\Catalog\Model\Product $product,$name){
        $price=$product->getData('price');
        if($price <60){
            $name .='so cheap';
        }else{
            $name .='so bloody expensive';
        }

        return $name;
    }
}