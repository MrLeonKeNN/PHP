<?php
class Player
{
    private $name, $city;
    private $isFake = false;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFake()
    {
        return $this->isFake;
    }

    public function setFake($isFake)
    {
        $this->isFake = $isFake;
        return $this;
    }

    public function toString()
    {
        if ($this->city == null) {
            return "$this->name" . "       ";
        }
        return "$this->name" . " ($this->city)" . "       ";
    }
}
