<?php
namespace SimplifiedMagento\FirstModule\NotMagento;

class RedPencil implements PencilInterface
{
    public function getPencilType(){
        return 'Red pencil';
    }
}