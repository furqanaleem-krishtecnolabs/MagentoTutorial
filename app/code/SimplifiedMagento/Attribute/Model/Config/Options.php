<?php


namespace SimplifiedMagento\Attribute\Model\Config;


use Laminas\Db\Metadata\Source\AbstractSource;

class Options extends AbstractSource
{
    public function getAllOptions(){
        $this->_options=[
            ['label'=>__('Gold'),'value'=>'gold'],
            ['label'=>__('Silver'),'value'=>'silver'],
            ['label'=>__('Bronze'),'value'=>'bronze'],

        ];
        return $this->_options;
    }
}