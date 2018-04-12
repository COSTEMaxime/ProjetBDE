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
        return $this->render('/Suggestions/ideas.html.twig');
    }

    /**
     * @Route("/ideas/{slug}", name="ideaSpecific")
     */
    public function suggestion($slug)
    {
        return $this->render('/Suggestions/idea.html.twig');
    }

    /**
     * @Route("/ideas/add", name="addIdea")
     */
    public function add()
    {
        return $this->render('/Suggestions/add.html.twig');
    }

    /**
     * @Route("/ideas/promote/{slug}", name="promoteIdea")
     */
    public function promote($slug)
    {
        return $this->render('/Suggestions/promote.html.twig');
    }

}