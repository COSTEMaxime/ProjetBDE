<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Entity\UserEntity;
use App\Form\RegisterForm;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    {
        $session = new Session();
        $session->set('logged', false);

        $task = new RegisterForm();
        $form = $this->createFormBuilder($task)
            ->add('firstName', TextType::class)
            ->add('lastName', textType::class)
            ->add('email', textType::class)
            ->add('password', PasswordType::class)
            ->add('passwordConfirm', PasswordType::class)
            ->add('Connect', SubmitType::class, array('label' => "S'enregistrer",'attr'=> array('class'=>'btn btn-primary')))
            ->getForm();


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();

            $firstName          =   $task->getFirstName();
            $lastName           =   $task->getLastName();
            $email              =   $task->getEmail();
            $password           =   $task->getPassword();
            $passwordConfirm    =   $task->getPasswordConfirm();


            if (!$this->userExist($email))
            {
                if (preg_match('~[A-Z]~', $password) &&
                    preg_match('~\d~', $password))
                {
                    if ($password === $passwordConfirm)
                    {
                        $manager = $this->getDoctrine()->getManager();

                        $user = new UserEntity();
                        $user->setPrenom($firstName);
                        $user->setNom($lastName);
                        $user->setMail($email);
                        $user->setMdp($password);
                        $user->setIDStatus(0);

                        $manager->persist($user);
                        $manager->flush();

                        return $this->redirectToRoute('homepage');
                    }
                    else
                    {
                        $_SESSION['passwordsDoesNotMatch'] = true;
                        return $this->redirectToRoute('register/index.html.twig');
                    }
                }
                else
                {
                    $_SESSION['passwordNotConform'] = true;
                    return $this->redirectToRoute('register/index.html.twig');
                }
            }
            else
            {
                $_SESSION['emailAlreadyTaken'] = true;
                return $this->redirectToRoute('/register/index.html.twig');
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    function userExist($email)
    {
        $result = $this->getDoctrine()
            ->getRepository(UserEntity::class)
            ->find($email);
        return $result;
    }
}