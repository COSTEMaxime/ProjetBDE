<?php

namespace App\Controller\Events;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends Controller
{
    /**
     * @Route("/events", name="eventsHomepage")
     */
    public function eventsHomepage()
    {
        return $this->render('/Events/events.html.twig');
    }

    /**
     * @Route("/events/{slug}", name="eventSpecific")
     */
    public function event($slug)
    {
        return $this->render('/Events/event.html.twig');
    }

    /**
     * @Route("/events/add", name="addEvent")
     */
    public function add()
    {
        return $this->render('/Events/event_add.html.twig');
    }
}