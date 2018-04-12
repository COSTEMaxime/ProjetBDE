<?php

namespace App\Controller\UserGestion;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function register()
    {
        return $this->render('/UserGestion/register.html.twig');
    }
}