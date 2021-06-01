<?php


namespace SimplifiedMagento\FirstModule\Model;

use SimplifiedMagento\FirstModule\Api\PencilInterface;
use SimplifiedMagento\FirstModule\Api\Color;
use SimplifiedMagento\FirstModule\Api\Size;

class Pencil implements PencilInterface
{
    protected  $color;
    protected  $size;
    protected $name;
    protected $school;
    public function __construct(Color $color,Size $size,$name=null,$school)
    {
        $this->color=$color;
        $this->size=$size;
        $this->name=$name;
        $this->school=$school;
    }

    public function getPencilType()
    {
        return "Our pencil has".$this->color->getColor()."Color and".$this->size->getSize()."size";
    }
}