<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DisconnectController extends Controller
{
    /**
     * @Route("/disconnect", name="disconnect")
     */
    public function index()
    {
        $session = new Session();
        $session->clear();

        return $this->redirectToRoute('homepage');
    }
}
