<?php

namespace App\Controller;

use App\Entity\CategoryFormEntity;
use App\Entity\PriceFormEntity;
use App\Entity\TypeEntity;
use App\Form\ShopSearchForm;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopController extends Controller
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index(Request $request)
    {

        $task = new ShopSearchForm();
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
            ->add('price', ChoiceType::class, [
                'choices' => [
                    new PriceFormEntity(0, 10),
                    new PriceFormEntity(10, 20),
                    new PriceFormEntity(20, 30),
                    new PriceFormEntity(30, 40),
                ],
                'choice_label' => function($price)   {
                    /** @var PriceFormEntity $price */
                    return sprintf('%.2f€ - %.2f€', $price->getMin(), $price->getMax());
                },
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ])
            ->add('research', TextType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $var = $form->getData();

            //Category
            foreach ($var->getCategory() as $var2)
            {
                /** @var CategoryFormEntity $var2 */
                echo $var2->getName();
            }

            //Price


            //Research
        }

        return $this->render('/Shop/shop.html.twig', [
            'form' => $form->createView()
        ]);
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

    /**
     * @Route("/shop/cart", name="cart")
     */
    public function cart(Request $request)
    {
        return $this->render('/Shop/cart.html.twig');
    }

    /**
     * @Route("/shop/admin", name="manageShop")
     */
    public function manage(Request $request)
    {
        return $this->render('/Shop/gestion.html.twig');
    }
}