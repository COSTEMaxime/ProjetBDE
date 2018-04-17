<?php

namespace App\Entity;


class PriceFormEntity
{

    protected $min;
    protected $max;

    function __construct($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function getMin()
    {
        return $this->min;
    }

    public function setMin($min): void
    {
        $this->min = $min;
    }

    public function getMax()
    {
        return $this->max;
    }

    public function setMax($max): void
    {
        $this->max = $max;
    }

}