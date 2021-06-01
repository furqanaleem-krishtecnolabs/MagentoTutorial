<?php


namespace SimplifiedMagento\FirstModule\Plugin;


class PluginSolution2
{
    public function beforeExecute(
        \SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject
    )
    {
        echo "before execute sort order 20";
    }
    public function afterExecute(
        \SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject
    ){
        echo "after execute sort order 20";
    }
    public function aroundExecute(
        \SimplifiedMagento\FirstModule\Controller\Page\HelloWorld $subject,callable $proceed
    ){

        echo "before proceed  sort order 20";
        $proceed();
        echo "after proceed sort order 20";
    }

}