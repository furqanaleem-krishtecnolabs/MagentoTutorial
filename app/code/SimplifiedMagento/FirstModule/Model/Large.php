<?php


namespace SimplifiedMagento\FirstModule\Model;


use SimplifiedMagento\FirstModule\Api\Size;

class Large implements Size
{

    public function getSize()
    {
        // TODO: Implement getSize() method.
        return 'big';
    }
}