<?php

namespace App\Controller;

use App\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MailController extends Controller
{
    /**
     * @Route("/shop/cart/commander", name="commandConfirm")
     */
    public function commandConfirm()
    {
        $session = new Session();

        $data = [
            'subject' => 'Confirm command : ',
            'body' => 'Merci de prendre rendez vous avec le BDE pour régler votre commande d\'un montant de'
        ];

        $recipient = $session->get('userInfo')->getMail();

        $mail = new Mail();
        $mail->sendMail($recipient, $data);

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/events/{slug}/flag", name="flagEvent")
     */
    public function flagEvent($slug)
    {
        $data = [
            'subject' => 'Flag event :'.$slug,
            'body' => 'Cet événement ne convient à l\'image de l\'école que nous voulons donner, merci de l\'enlever'
        ];

        $mail = new Mail();
        $mail->sendMail('maxime.coste@viacesi.com', $data);

    }
}