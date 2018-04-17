<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\UserEntity;
use App\Form\RegisterForm;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    {
        $task = new RegisterForm();
        $form = $this->createFormBuilder($task)
            ->add('firstName', TextType::class)
            ->add('lastName', textType::class)
            ->add('email', textType::class)
            ->add('password', textType::class)
            ->add('passwordConfirm', textType::class)
            ->add('Connect', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $task = $form->getData();

            $firstName          =   $task->getFirstName();
            $lastName           =   $task->getLastName();
            $email              =   $task->gestEmail();
            $password           =   $task->getPassword();
            $passwordConfirm    =   $task->getPasswordConfirm();


            if (!$this->userExist($email))
            {
                if ($password === $passwordConfirm)
                {
                    $manager = $this->getDoctrine()->getManager();

                    $user = new UserEntity();
                    $user->setPrenom($firstName);
                    $user->setNom($lastName);
                    $user->setMail($email);
                    $user->setIDStatus(0);

                    $manager->persist($user);
                    $manager->flush();

                    return $this->redirectToRoute('index.html.twig');
                }
                else
                {
                    $_SESSION['passwordsDoesNotMatch'] = true;
                    return $this->redirectToRoute('register/index.html.twig');
                }
            }
            else
            {
                $_SESSION['emailAlreadyTaken'] = true;
                return $this->redirectToRoute('register/index.html.twig');
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form
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