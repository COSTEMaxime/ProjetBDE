<?php

namespace App\Controller;

use App\Entity\ActiviteEntity;
use App\Entity\CommentEntity;
use App\Entity\CommentLikeEntity;
use App\Entity\LikeEntity;
use App\Repository\CommentLikeEntityRepository;
use App\Repository\LikeEntityRepository;
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
        //Get 10 lasts ideas
        $ideas = $this->getDoctrine()
            ->getRepository(ActiviteEntity::class)
            ->findAllLimit(10);

        //Get ideas' id
        $ideasId = array();
        foreach ($ideas as $idea) {
            /** @var ActiviteEntity $idea */
            array_push($ideasId, $idea->getId());
        }

        //Get comments where parent is idea
        $comments = $this->getDoctrine()
            ->getRepository(CommentEntity::class)
            ->findBy(['id' => $ideasId]);

        //Get the number of like per comment
        $commentsLikes = array();
        foreach ($comments as $comment) {
            /** @var CommentEntity $comment */
            array_push($commentsLikes, [
                $comment->getId() => $this->getDoctrine()
                                        ->getRepository(CommentLikeEntity::class)
                                        ->getNbLikes($comment->getId())
            ]);
        }

        //faire pareil pour les likes sur les idées
        $ideasLikes = $this->getDoctrine()
            ->getRepository(LikeEntity::class);
            ->getNbLikes();
        $ideasDislikes= $this->getDoctrine()
            ->getRepository(LikeEntity::class);


        return $this->render('idea/index.html.twig', [
            'ideas' => $ideas,
            'comments' => $comments,
            'ideasLikes' => $ideasLikes,
            'ideasDislikes' => $ideasDislikes,
            'commentsLikes' => $commentsLikes
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
