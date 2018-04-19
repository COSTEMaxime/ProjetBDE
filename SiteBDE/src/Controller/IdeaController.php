<?php

namespace App\Controller;

use App\CONSTANTS;
use App\Entity\ActiviteEntity;
use App\Entity\LikeEntity;
use App\Entity\ManifestationEntity;
use App\Entity\PhotoEntity;
use App\Form\AddIdeaForm;
use App\Form\AddEventForm;
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
        //On va récupérer pour savoir si l'user a déjà like

        $like = $this->getDoctrine()
            ->getRepository(LikeEntity::class)
            ->findBy(['IDUser' => $session->get('userInfo')->getId()]);


        return $this->render('idea/index.html.twig', [
            'ideas' => $data,
            'like' => $like
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
                CONSTANTS::$UPLOADS_DIR,
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
     * @Route("/ideas/transform/{slug}", name="transformIdea")
     */
    public function transformIdea($slug,Request $request)
    {
        $session = new Session();

        //Récupérer data
        $result = $this->getDoctrine()
            ->getRepository(ActiviteEntity::class);
        $req = $result->findBy(array('titre' => $slug)); //On récupère les données de la table à partir du nom

        //Image
        $result2 = $this->getDoctrine()
        ->getRepository(PhotoEntity::class);
        $img = $result2->find($req[0]->getIDphoto());
        //$img = $result->findBy(array('path' => $slug));

        //Formulaire
        $task = new AddEventForm();
        $form = $this->createFormBuilder($task)
            ->add('titre', TextType::class)
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, array('label' => 'Image','attr'=> array('name'=>'img','onchange'=>"readURL(this)")))
            ->add('date', DateType::class,array('label' => 'Image','attr'=> array('id'=>'datepicker')), [
                'widget' => 'single_text'
            ])
            ->add('recurrence', ChoiceType::class, [
                'choices' => [
                    'Aucune' => '0',
                    'Journalière' => '1',
                    'Hebdomadaire' => '2',
                    'Annuelle' => '3',
                ]
            ])
            ->add('price', IntegerType::class)
            ->add('submit', SubmitType::class, array('label' => "Créer l'évènement",'attr'=> array('class'=>'btn btn-primary')))
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
            $idea = new ManifestationEntity();
            $idea->setTitre($data->getTitre());
            $idea->setContenu($data->getDescription());
            $idea->setDateManifestation($data->getDate());
            $idea->setIDActivite(-1);
            $idea->setImage($fileName);
            $idea->setTypeRecurrence($data->getRecurrence());
            $idea->setPrix($data->getPrice());
            $idea->setIsFlagged(false);
            $idea->setIDuser(-1);
            //TODO
            //$idea->setIDuser(getCurrentUser());

            $manager->persist($idea);
            $manager->flush();

            return $this->redirectToRoute('events');
        }



        return $this->render('idea/transform.html.twig', [
            'form' => $form->createView(),
            'req' => $req[0],
            'photo' => $img
        ]);
    }

    /**
     * @Route("/ideas/like/{slug}", name="likeIdea")
     */
    public function likeIdea($slug)
    {
        $session = new Session();

        $manager = $this->getDoctrine()->getManager(); //Manager
        $like = new LikeEntity();
        $like->setIDActivite($slug);//Date du jour à mettre
        $like->setIsLike(1);
        $like->setIDUser($session->get('userInfo')->getId());
        $like->setIsDisliked(0);
        $manager->persist($like);

        $activite = $this->getDoctrine()
            ->getRepository(ActiviteEntity::class)
            ->find($slug);
        $activite->setnbLike($activite->getnbLike()+1);
        $manager->persist($activite);

         //Envoyer data
        $manager->flush();

        return $this->redirectToRoute('ideas');
    }

    /**
     * @Route("/ideas/dislike/{slug}", name="dislikeIdea")
     */
    public function dislikeIdea($slug)
    {
        $session = new Session();

        $manager = $this->getDoctrine()->getManager(); //Manager
        $like = new LikeEntity();
        $like->setIDActivite($slug);//Date du jour à mettre
        $like->setIsLike(0);

        $like->setIDUser($session->get('userInfo')->getId());
        $like->setIsDisliked(1);
        $manager->persist($like);

        $activite = $this->getDoctrine()
            ->getRepository(ActiviteEntity::class)
            ->find($slug);
        $activite->setnbDislike($activite->getnbDislike()+1);
        $manager->persist($activite);

        //Envoyer data
        $manager->flush();

        return $this->redirectToRoute('ideas');
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
