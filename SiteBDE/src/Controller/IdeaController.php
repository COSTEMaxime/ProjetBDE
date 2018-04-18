<?php

namespace App\Controller;

use App\Entity\ActiviteEntity;
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
            ->add('submit', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        $form->handleRequest($request);

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
}
