<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Entity\UserEntity;
use App\Form\LoginForm;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request)
    {
        $task = new LoginForm();
        $form = $this->createFormBuilder($task)
            ->add('login', TextType::class)
            ->add('password', PasswordType::class)
            ->add('Connect', SubmitType::class, array('label' => 'Se connecter','attr'=> array('class'=>'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();

            $login      =   $task->getLogin();
            $password   =   $task->getPassword();

            if($this->isLoginCorrect($login, $password))
            {
                $_SESSION['connected'] = true;
                $_SESSION['status'] = $this->getStatus($login);
            }
            else
            {
                $_SESSION['connected'] = false;
                $_SESSION['wrongPassword'] = true;
            }

            return $this->redirectToRoute('index.html.twig');
        }
        return $this->render('login/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    function isLoginCorrect($login, $password)
    {
        $result = $this->getDoctrine()
            ->getRepository(UserEntity::class)
            ->findOneBy([
                'mail' => $login,
                'mdp' => $password
            ]);
        return $result;
    }

    function getStatus($login)
    {
        $result = $this->getDoctrine()
            ->getRepository(UserEntity::class)
            ->find($login);

        return $result->getIDStatus();
    }
}