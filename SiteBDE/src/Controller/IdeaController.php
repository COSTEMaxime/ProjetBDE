<?php

namespace App\Controller;

use App\Entity\ActiviteEntity;
use App\Entity\ManifestationEntity;
use App\Entity\PhotoEntity;
use App\Form\AddIdeaForm;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IdeaController extends Controller
{
    /**
     * @Route("/ideas", name="ideas")
     */
    public function index()
    {
        $session = new Session();

        //Get 10 lasts ideas
        $ideas = $this->getDoctrine()
            ->getRepository(ActiviteEntity::class)
            ->findAllLimit(10);

        $data = array();
        foreach ($ideas as $idea) {
            /** @var ActiviteEntity $idea */
            $result = $this->getDoctrine()
                ->getRepository(PhotoEntity::class)
                ->findOneBy(['id' => $idea->getIDphoto()]);
            array_push($data, [$idea, 'pathPhoto' => $result->getPath()]);
        }

        return $this->render('idea/index.html.twig', [
            'ideas' => $data,
        ]);
    }

        /**
         * @Route("/ideas/add", name="addIdea")
         */
    public function addIdea(Request $request)
    {
        $session = new Session();

        $task = new AddIdeaForm();
        $form = $this->createFormBuilder($task)
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, array('label' => 'Image','attr'=> array('name'=>'img','onchange'=>"readURL(this)")))
            ->add('submit', SubmitType::class, array('label' => 'Proposer mon idée','attr'=> array('class'=>'btn btn-primary')))

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
                'Uploads/',
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

        return $this->render('idea/idea_add.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/ideas/transform", name="transformIdea")
     */
    public function transformIdea()
    {
        $session = new Session();

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

    private function getLastImageID()
    {
        $result = $this->getDoctrine()
            ->getRepository(PhotoEntity::class)
            ->findOneBy([], [
                'id' => 'DESC'
            ]);
        return $result->getId();
    }
}
