<?php

namespace App\Controller;

use App\Entity\CategoryFormEntity;
use App\Entity\PanierEntity;
use App\Entity\PhotoEntity;
use App\Entity\ProduitEntity;
use App\Entity\TypeEntity;
use App\Form\ShopResearchForm;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(Request $request)
    {
        $session = new Session();

        $articles = $this->getDoctrine()
            ->getRepository(ProduitEntity::class)
            ->findMostOrdered(3);

        $data = array();
        foreach ($articles as $article) {
            /** @var ProduitEntity $article */
            $result = $this->getDoctrine()
                ->getRepository(PhotoEntity::class)
                ->findOneBy(['id' => $article->getIdPhoto()]);
            array_push($data, [$articles, 'pathPhoto' => $result->getPath()]);
        }

        return $this->render('Shop/shop.html.twig', [
            'articles' => $data
        ]);
    }

    /**
     * @Route("/shop/research", name="shopResearch")
     */
    public function shopResearch(Request $request)
    {
        $session = new Session();

        $task = new ShopResearchForm();
        $form = $this->createFormBuilder($task)
            ->add('category', ChoiceType::class, [
                'choices' => $this->generateChoices(),
                'choice_label' => function($category) {
                    /** @var CategoryFormEntity $category */
                    return $category->getName();
                },
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ])
            ->add('maxPrice', IntegerType::class, [
                'required' => false
            ])
            ->add('research', TextType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class, array('label' => 'Rechercher','attr'=> array('class'=>'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $category = array();
            foreach ($data->getCategory() as $cat) {
                /** @var CategoryFormEntity $cat */
                array_push($category, $cat->getName());
            }

            $maxPrice = is_null($data->getMaxPrice()) ? null : $data->getMaxPrice();
            $research = is_null($data->getResearch()) ? null : $data->getResearch();

            $result = $this->getDoctrine()
                ->getRepository(ProduitEntity::class)
                ->findAllWithCriteria($category, $maxPrice, $research);

            /* Récupérer la photo avec les données*/
            $data = array();
            foreach ($result as $idea) {
                /** @var ActiviteEntity $idea */
                $result = $this->getDoctrine()
                    ->getRepository(PhotoEntity::class)
                    ->findOneBy(['id' => $idea->getIDphoto()]); //On récupère l'IDPhoto
                array_push($data, [$idea, 'pathPhoto' => $result->getPath()]);
            }
            //////////////////////////////

            return $this->render('Shop/search.html.twig', [
                'form' => $form->createView(),
                'donnees' => $data
            ]);
        }

        return $this->render('/Shop/search.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/shop/cart", name="cart")
     */
    public function cart(Request $request)
    {
        $session = new Session();

        $result = $this->getDoctrine()
            ->getRepository(PanierEntity::class);
        $req = $result->findAll(); //On récupère toutes les données
        $panier = array(); //On stockera les données dans le tableau

        foreach ($req as $data) {
            $result2 = $this->getDoctrine()
                ->getRepository(ProduitEntity::class);
            $nomProduit = $result2->find($data->getIDproduit()); //On récupère les données de la table à partir de l'ID
            array_push($panier, [$nomProduit,$data]);
        }
        return $this->render('Shop/cart.html.twig', [
            'panier' => $panier,
        ]);
    }


    /**
     * @Route("/product/new", name="newProduct", methods={"POST"})
     */
    public function new(Request $request)
    {

    }

    /**
     * @Route("/product/{id}", name="uniqueArticle", methods={"GET"})
     */
    public function show(ProduitEntity $produitEntity)
    {

    }

    /**
     * Route("/article/{id}/edit", name="editArticle", methods={"GET|POST"})
     */
    public function edit(Request $request, ProduitEntity $produitEntity)
    {

    }

    /**
     * @Route("/articles/{id}", name="deleteArticle", methods={"DELETE"})
     */
    public function delete(Request $request, ProduitEntity $produitEntity)
    {

    }

    function generateChoices()
    {
        $result = $this->getDoctrine()
            ->getRepository(TypeEntity::class)
            ->findAll();

        $data = array();

        foreach ($result as $test)  {
            array_push($data, new CategoryFormEntity($test->getName()));
        }

        return $data;
    }
}