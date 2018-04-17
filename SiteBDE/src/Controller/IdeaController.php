<?php

namespace App\Controller;

use App\Entity\ActiviteEntity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IdeaController extends Controller
{
    /**
     * @Route("/ideas", name="ideas")
     */
    public function index()
    {
        $ideas = $this->getDoctrine()
            ->getRepository(ActiviteEntity::class)
            ->findAllLimit(10);

        $comments = null;

        return $this->render('idea/index.html.twig', [
            'ideas' => $ideas,
            'comments' => $comments
        ]);
    }

    /**
     * @Route("/ideas/add", name="addIdea")
     */
    public function addIdea(Request $request)
    {

    }

    /**
     * @Route("/ideas/transform", name="transformIdea")
     */
    public function transformIdea()
    {

    }
}
