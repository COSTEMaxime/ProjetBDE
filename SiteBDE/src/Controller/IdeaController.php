<?php

namespace App\Controller;

use App\Entity\ActiviteEntity;
use App\Entity\PhotoEntity;
use App\Form\AddIdeaForm;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\File;
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

        return $this->render('idea/index.html.twig', [
            'ideas' => $ideas
        ]);
    }

    /**
     * @Route("/ideas/add", name="addIdea")
     */
    public function addIdea(Request $request)
    {
        $task = new AddIdeaForm();
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
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('images'),
                $fileName
            );

            $manager = $this->getDoctrine()->getManager();

            $image = new PhotoEntity();
            $image->setIsFlagged(false);
            $image->setNblike(0);
            $image->setPath($fileName);
            //TODO
            //$image->setIDuser(getCurrentUserID());

            $manager->persist($image);

            //Add the idea
            $idea = new ActiviteEntity();
            $idea->setTitre($data->getTitre());
            $idea->setContenu($data->getDscription());
            $idea->setNbLike(0);
            $idea->setNbDislike(0);
            //TODO
            //$idea->setIDuser(getCurrentUser());

            $manager->persist($idea);
            $manager->flush();

            $this->redirectToRoute('/ideas');
        }

        return $this->render('Events/event.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/ideas/transform", name="transformIdea")
     */
    public function transformIdea()
    {

    }

    /**
     * @Route("/ideas/like", name="likeIdea")
     */
    public function likeIdea()
    {

    }

    /**
     * @Route("/ideas/dislike", name="dislikeIdea")
     */
    public function dislikeIdea()
    {

    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
