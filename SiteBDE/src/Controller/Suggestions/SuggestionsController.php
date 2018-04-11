<?php

namespace App\Controller\Suggestions;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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