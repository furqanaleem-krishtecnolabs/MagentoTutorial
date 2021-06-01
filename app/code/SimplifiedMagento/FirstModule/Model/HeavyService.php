<?php


namespace SimplifiedMagento\FirstModule\Model;


class HeavyService
{
    public function __construct(){
        echo "heavy service has been instantiated"."<br/>";
    }
    public function printHeavyServiceMessage(){
        echo "heavy service class";
    }

}