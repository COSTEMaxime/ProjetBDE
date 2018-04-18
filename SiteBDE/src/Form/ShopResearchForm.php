<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;


class ShopResearchForm
{
    protected $category;
    protected $maxPrice;
    protected $research;

    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    public function setMaxPrice($maxPrice): void
    {
        $this->maxPrice = $maxPrice;
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