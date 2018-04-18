<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    /**
     * @Route("/events", name="event")
     */
    public function index()
    {
        /*
        //Get comments where parent is idea
        $comments = $this->getDoctrine()
            ->getRepository(CommentEntity::class)
            ->findBy(['id' => $ideasId]);

        //Get the number of like per comment
        $commentsLikes = array();
        foreach ($comments as $comment) {
            /** @var CommentEntity $comment */
            /**array_push($commentsLikes, [
                $comment->getId() => $this->getDoctrine()
                    ->getRepository(CommentLikeEntity::class)
                    ->getNbLikes($comment->getId())
            ]);
        }

                      //Get ideas' id
            $ideasId = array();
            foreach ($ideas as $idea) {
            /** @var ActiviteEntity $idea */
        /*array_push($ideasId, $idea->getId());
    }*/

        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
