<?php

namespace App\Form;


class AddIdeaForm
{
    protected $titre;
    protected $description;
    protected $image;

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }
}