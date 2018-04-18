<?php

namespace App\Controller;

use App\CSVConverter;
use App\Entity\InscritManifestationEntity;
use App\Entity\ManifestationEntity;
use App\Entity\PhotoEntity;
use App\Form\AddEventForm;
use App\PDFConverter;
use App\QueryResultConverter;
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

class EventController extends Controller
{
    /**
     *  @Route("/events/{slug}", name="event")
     */
    public function event($slug)
    {
        $session = new Session();

        $event = $this->getDoctrine()
            ->getRepository(ManifestationEntity::class)
            ->findOneBy(array('titre' => $slug));

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

        return $this->render('Events/event.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * @Route("/events/{slug}/toPDF", name="downloadEventPDF", methods={"POST"})
     */
    public function downloadPDF($slug)
    {
        try {
            PDFConverter::generateFromData([
                'data' => $this->getInscrits($slug),
                'header' => $slug
            ]);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }
    }

    /**
     * @Route("/events/{slug}/toCSV", name="downloadEventCSV", methods={"POST"})
     */
    public function downloadCSV($slug)
    {
        try {
            CSVConverter::generateFromData([
                'data' => $this->getInscrits($slug),
                'header' => $slug
            ]);
        }
        catch (\Exception $e)
        {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }

        return $this->file($slug.'csv');
    }

    /**
     * @Route("/events", name="events")
     */
    public function index()
    {
        $session = new Session();

        //Get 10 lasts events
        $events = $this->getDoctrine()
            ->getRepository(ManifestationEntity::class)
            ->findAllLimit(10);

        return $this->render('Events/event.html.twig', [
            'events' => $events
        ]);
    }

    /**
     * @Route("/events/add", name="addEvent")
     */
    public function addEvent(Request $request)
    {
        $session = new Session();

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

        return $this->render('Events/event_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    private function getInscrits($eventName)
    {
        $event = $this->getDoctrine()
            ->getRepository(ManifestationEntity::class)
            ->findOneBy(array('titre' => $eventName));

        return $this->getDoctrine()
            ->getRepository(InscritManifestationEntity::class)
            ->findBy(array('IDManifestation' => $event->getId()));
    }

}
