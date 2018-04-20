<?php

namespace App\Controller;

use App\CONSTANTS;
use App\CSVConverter;
use App\Entity\InscritManifestationEntity;
use App\Entity\ManifestationEntity;
use App\Entity\PhotoEntity;
use App\Form\AddEventForm;
use App\Entity\CommentEntity;
use App\PDFConverter;
use App\Entity\ActiviteEntity;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \ZipArchive;

class EventController extends Controller
{
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
                CONSTANTS::$UPLOADS_DIR,
                $fileName
            );

            $manager = $this->getDoctrine()->getManager();

            $image = new PhotoEntity();
            $image->setIsFlagged(false);
            $image->setNblike(0);
            $image->setPath($fileName);
            $image->setIDuser($session->get('userInfo')->getId());

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
            $idea->setIDuser($session->get('userInfo')->getId());

            $manager->persist($idea);
            $manager->flush();

            return $this->redirectToRoute('events');
        }

        return $this->render('Events/event_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/events/{slug}/toPDF", name="downloadEventPDF", methods={"GET"})
     */
    public function downloadPDF($slug)
    {
        $fileName = CONSTANTS::$DOWNLOADS_DIR.preg_replace('/\s+/', '_', $slug).'.pdf';

        try {
            PDFConverter::generateFromData([
                'data' => $this->getInscrits($slug),
                'header' => $fileName
            ]);
        }
        catch (\Exception $e) {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }

        return new JsonResponse(null);
    }

    /**
     * @Route("/events/{slug}/toCSV", name="downloadEventCSV", methods={"GET"})
     */
    public function downloadCSV($slug)
    {
        $fileName = CONSTANTS::$DOWNLOADS_DIR.preg_replace('/\s+/', '_', $slug).'.csv';

        try {
            CSVConverter::generateFromData([
                'data' => $this->getInscrits($slug),
                'header' => $fileName
            ]);
        }
        catch (\Exception $e)
        {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }

        return $this->file($fileName);
    }

    /**
     * @Route("/events/{slug}/inscription", name="event_inscription", methods={"GET"})
     */
    public function inscription($slug)
    {
        $session = new Session();

        $manager = $this->getDoctrine()->getManager(); //Manager

        $activite = $this->getDoctrine()
            ->getRepository(ManifestationEntity::class)
            ->findOneBy(array('titre' => $slug));

        $insc = new InscritManifestationEntity();
        $insc->setIDManifestation($activite->getId());
        $insc->setIDuser($session->get('userInfo')->getId());

        $manager->persist($insc);
        //Envoyer data
        $manager->flush();

        return $this->redirectToRoute('event', array('slug' => $slug));
    }

    /**
     * @Route("/events/{slug}/downloadImg", name="downloadImages", methods={"GET"})
     */
    public function downloadImages($slug)
    {
        $event = $this->getDoctrine()
            ->getRepository(ManifestationEntity::class)
            ->findOneBy(array('titre' => $slug));

        $photosAComment = $this->getDoctrine()
            ->getRepository(CommentEntity::class)
            ->findBy(array('IdParent' => $event->getId()));

        if(!$photosAComment)    {
            return null;
        }

        $zip = new ZipArchive();
        $fileName = CONSTANTS::$DOWNLOADS_DIR.preg_replace('/\s+/', '_', $slug).'.zip';

        try {
            if($zip->open($fileName, \ZipArchive::CREATE) !== true) {
                throw new \Exception('Error : can\'t open the file :' . $fileName);
            }
        }
        catch (\Exception $e)
        {
            echo $e->getMessage();
            echo $e->getTraceAsString();
        }

        foreach ($photosAComment as $key) {
            $photo = $this->getDoctrine()
                ->getRepository(PhotoEntity::class)
                ->findBy(array('id' => $key->getIdPhoto()));

            $zip->addFile(CONSTANTS::$UPLOADS_DIR.$photo[0]->getPath());
        }

        $zip->close();

        return $this->file($fileName);
    }

    /**
     *  @Route("/events/{slug}", name="event")
     */
    public function event($slug,Request $request)
    {
        $session = new Session();

        $event = $this->getDoctrine() //Manifestation
            ->getRepository(ManifestationEntity::class)
            ->findOneBy(array('titre' => $slug));

        $inscription = $this->getDoctrine() //Pour liste inscription
            ->getRepository(InscritManifestationEntity::class)
            ->findBy(array('IDManifestation' => $event->getId()));


        $photosAComment = $this->getDoctrine()
            ->getRepository(CommentEntity::class)
            ->findBy(array('IdParent' => $event->getId()));

        $tabphotos = array(); //Liste des photos
        foreach ($photosAComment as $key) {
            $photos = $this->getDoctrine()
                ->getRepository(PhotoEntity::class)
                ->findBy(array('id' => $key->getIdPhoto() ));
            array_push($tabphotos, $photos);
        }

        //Formulaire :
        $task = new AddEventForm();
        $form = $this->createFormBuilder($task)
            ->add('image', FileType::class, array('label' => 'Image','attr'=> array('name'=>'img','onchange'=>"readURL(this)")))
            ->add('description', TextareaType::class)
            ->add('submit', SubmitType::class, array('label' => "Ajouter ma photo",'attr'=> array('class'=>'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        //Submit - Ajout d'une photo avec son commentaire
        if($form->isSubmitted() && $form->isSubmitted())
        {
            $data = $form->getData(); //Récupération donnée

            //File gestion
            $file = $data->getImage(); //Image
            /** @var File $file */
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                'Uploads/',
                $fileName
            );

            $manager = $this->getDoctrine()->getManager();
            /* Ajout de la photo*/
            $image = new PhotoEntity();
            $image->setIsFlagged(false);
            $image->setNblike(0);
            $image->setPath($fileName);
            $image->setIDuser($session->get('userInfo')->getId());

            $manager->persist($image);
            $manager->flush();

            /*Ajout du commentaire*/
            $commentary = new CommentEntity();

            $commentary->setComment($form["description"]->getData());
            $time = new \DateTime();

            $time->format('H:i:s \O\n Y-m-d');
            $commentary->setDateComment($time);//Date du jour à mettre

            $commentary->setIsFlagged(false);
            $commentary->setIdLike(-1);


            $commentary->setIdParent($event->getId()); //id de l'event dans lequel on est
            $commentary->setIdPhoto($image->getId());

            $manager->persist($commentary); //Envoyer data
            $manager->flush();

            return $this->redirectToRoute('event', array('slug' => $slug));
        }

        $isInscrit = 0;

        //Pour empêcher de se réinscrire
        if (isset($inscription)) {

            $var = $this->getDoctrine()
                ->getRepository(InscritManifestationEntity::class)
                ->findBy([
                    'IDuser' => $session->get('userInfo')->getId(),
                    'IDManifestation' => $event->getId()
                ]);

            if ($var) {
                $isInscrit = 1;
            }
        }

        return $this->render('Events/event.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
            'slug' => $slug,
            'photosAComment' => $photosAComment,
            'photo' => $tabphotos,
            'inscription' => $isInscrit
        ]);
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



        //$url = $this->generateUrl('event', array('slug' => 'monSlug'));

        return $this->render('event/index.html.twig', [
            'events' => $events,
            //'url' => $url
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
