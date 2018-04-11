<?php

namespace App\Controller\Suggestions;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SuggestionsController extends Controller
{
    /**
     * @Route("/ideas", name="ideas")
     */
    public function suggestionsHomepage()
    {

    }

    /**
     * @Route("/ideas/{slug}", name="ideaSpecific")
     */
    public function suggestion($slug)
    {

    }

    /**
     * @Route("/ideas/add", name="addIdea")
     */
    public function add()
    {

    }

    /**
     * @Route("/ideas/promote/{slug}", name="promoteIdea")
     */
    public function promote($slug)
    {

    }

}