<?php


namespace SimplifiedMagento\FirstModule\Model;


class Student
{
    private $name;
    private $age;
    private $scores;
    public function __construct($name ='Alex',$age=20,
array $scores=array('math'=>92,'programming'=>90))
    {
        $this->name=$name;
        $this->age=$age;
        $this->scores=$scores;

    }
}