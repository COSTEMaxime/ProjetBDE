<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $session = new Session();

        return $this->render('index.html.twig', [
            'session' => $session->get('logged')
        ]);
    }
}