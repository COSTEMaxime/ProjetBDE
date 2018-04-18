<?php

namespace App\Form;


class AddEventForm extends AddIdeaForm
{
    protected $date;
    protected $recurrence;
    protected $price;

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getRecurrence()
    {
        return $this->recurrence;
    }

    public function setRecurrence($recurrence): void
    {
        $this->recurrence = $recurrence;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }
}