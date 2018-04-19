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
use Symfony\Component\HttpFoundation\JsonResponse;
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

            $maxPrice = is_null($data->getMaxPrice()) ? PHP_INT_MAX : $data->getMaxPrice();
            $research = is_null($data->getResearch()) ? null : $data->getResearch();

            $result = $this->getDoctrine()
                ->getRepository(ProduitEntity::class)
                ->findAllWithCriteria($category, $maxPrice, $research);

            return $this->render('Shop/search.html.twig', [
                'form' => $form->createView(),
                'result' => $result
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
     * @Route("/product/{id}", name="uniqueArticle", methods={"GET"})
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(ProduitEntity::class)
            ->findOneBy(['id' => $id]);

        if($product) {
            return new JsonResponse($product->jsonSerialize());
        }
        else    {
            return new JsonResponse(['error' => 'ID not found']);
        }
    }

    /**
     * @Route("/product/new", name="newProduct", methods={"POST"})
     */
    public function new()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if(isset($data['nom'])
            && isset($data['description'])
            && isset($data['prix'])
            && isset($data['type'])
            && isset($data['nb_de_fois'])
            && isset($data['id_photo']))
        {
            $manager = $this->getDoctrine()->getManager();

            $product = new ProduitEntity();
            $product->setNom($data['nom']);
            $product->setDescription($data['description']);
            $product->setPrix($data['prix']);
            $product->setType($data['type']);
            $product->setNbDeFois($data['nb_de_fois']);
            $product->setIdPhoto($data['id_photo']);

            $manager->persist($product);
            $manager->flush();

            return new JsonResponse([
                'message' => 'Added new product !',
                'product' => $product->jsonSerialize()
            ]);
        }
        else    {
            return new JsonResponse(['error' => 'Missing argument']);
        }
    }

    /**
     * @Route("/product/{id}/edit", name="editArticle", methods={"PUT"})
     */
    public function edit($id)
    {
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository(ProduitEntity::class)
            ->findOneBy(['id' => $id]);

        if($product)
        {
            $data = json_decode(file_get_contents('php://input'), true);

            if(isset($data['nom']))             {$product->setNom($data['nom']);}
            if(isset($data['description']))     {$product->setDescription($data['description']);}
            if(isset($data['prix']))            {$product->setPrix($data['prix']);}
            if(isset($data['type']))            {$product->setType($data['type']);}
            if(isset($data['nb_de_fois']))      {$product->setNbDeFois($data['nb_de_fois']);}
            if(isset($data['id_photo']))        {$product->setIdPhoto($data['id_photo']);}

            $manager->flush();

            return new JsonResponse(['message' => 'Modified product : '.$id]);
        }
        else    {
            return new JsonResponse(['error' => 'ID not found']);
        }

    }

    /**
     * @Route("/product/{id}", name="deleteArticle", methods={"DELETE"})
     */
    public function delete($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(ProduitEntity::class)
            ->findOneBy(['id' => $id]);

        if($product)
        {
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($product);
            $manager->flush();

            return new JsonResponse(['message' => 'Deleted product : '.$id]);
        }
        else    {
            return new JsonResponse(['error' => 'ID not found']);
        }
    }

    private function generateChoices()
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