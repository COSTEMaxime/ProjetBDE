<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
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
        $session = new Session();

        $task = new LoginForm();
        $form = $this->createFormBuilder($task)
            ->add('login', TextType::class)
            ->add('password', PasswordType::class)
            ->add('Connect', SubmitType::class, array('label' => 'Se connecter','attr'=> array('class'=>'btn btn-primary','onclick'=>"verifierFormulaire()")))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();

            $login      =   $task->getLogin();
            $password   =   $task->getPassword();

            $user = $this->isLoginCorrect($login, $password);
            if($user !== null)
            {
                $session->set('logged', true);
                $session->set('userInfo', $user);
            }
            else
            {
                $session->set('logged', false);
                $session->set('wrongLongin', true);
            }
            return $this->redirectToRoute('homepage');
        }
        return $this->render('login/index.html.twig', [
            'form' => $form->createView(),
            'session' => $session
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
}
