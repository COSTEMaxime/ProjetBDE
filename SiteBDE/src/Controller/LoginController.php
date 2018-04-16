<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\UserEntity;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function index()
    {
        $login = null;
        $mdp = null;

        if(isset($_POST['login']))  {
            $login = $_POST['login'];
        }

        if(isset($_POST['mdp']))    {
            $mdp = $_POST['mdp'];
        }

        if($this->isLoginCorrect($login, $mdp))
        {
            $_SESSION['connected'] = true;
            $_SESSION['status'] = $this->getStatus($login);
        }
        else
        {
            $_SESSION['connected'] = false;
            $_SESSION['wrongPassword'] = true;
        }

        return $this->render('index.html.twig');
    }

    function isLoginCorrect($login, $mdp)
    {
        $result = $this->getDoctrine()
            ->getRepository(UserEntity::class)
            ->findOneBy([
                'mail' => $login,
                'mdp' => $mdp
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
