<?php

namespace App\Form;


class ShopSearchForm
{
    protected $category;
    protected $price;
    protected $research;

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getResearch()
    {
        return $this->research;
    }

    public function setResearch($research): void
    {
        $this->research = $research;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category): void
    {
        $this->category = $category;
    }
}