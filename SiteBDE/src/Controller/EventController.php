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

    /**
     * @Route("/events/add", name="addEvent")
     */
    public function addEvent()
    {
        /**
        $task = new AddEventForm();
        $form = $this->createFormBuilder($task)
            ->add('titre', TextType::class)
            ->add('description', TextType::class)
            ->add('image', FileType::class)
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isSubmitted())
        {
            $data = $form->getData();

            //File gestion
            $file = $data->getImage();
            /** @var File $file */
            /**$fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                'images/',
                $fileName
            );

            $manager = $this->getDoctrine()->getManager();

            $image = new PhotoEntity();
            $image->setIsFlagged(false);
            $image->setNblike(0);
            $image->setPath($fileName);
            $image->setIDuser(-1);
            //TODO
            //$image->setIDuser(getCurrentUserID());

            $manager->persist($image);
            $manager->flush();

            //Add the idea
            $idea = new ActiviteEntity();
            $idea->setTitre($data->getTitre());
            $idea->setContenu($data->getDescription());
            $idea->setIDphoto($this->getLastImageID());
            $idea->setNbLike(0);
            $idea->setNbDislike(0);
            $idea->setIDuser(-1);
            //TODO
            //$idea->setIDuser(getCurrentUser());

            $manager->persist($idea);
            $manager->flush();

            return $this->redirectToRoute('ideas');
        }
             * */
        return $this->render('Events/event_add.html.twig', [
            'controller_name' => 'EventController',
        ]);

    }
}
