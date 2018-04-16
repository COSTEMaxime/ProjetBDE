<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\UserEntity;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function index()
    {
        $firstName = null;
        $lastName = null;
        $email = null;
        $password = null;
        $passwordConfirm = null;

        if (isset($_POST['prenom']))  {
            $firstName = $_POST['prenom'];
        }

        if (isset($_POST['nom']))  {
            $lastName = $_POST['nom'];
        }

        if (isset($_POST['email']))  {
            $email = $_POST['email'];
        }

        if (isset($_POST['mdp1']))  {
            $password = $_POST['mdp1'];
        }

        if (isset($_POST['mdp2']))   {
            $passwordConfirm = $_POST['mdp2'];
        }

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
            }
            else
            {
                $_SESSION['passwordsDoesNotMatch'] = true;
            }
        }
        else
        {
            $_SESSION['emailAlreadyTaken'] = true;
        }

        return $this->render('login/index.html.twig');
    }

    function userExist($email)
    {
        $result = $this->getDoctrine()
            ->getRepository(UserEntity::class)
            ->find($email);

        return $result;
    }
}