<?php

namespace App\Form;


class AddIdeaForm
{
    protected $titre;
    protected $description;
    protected $photo;

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

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }
}