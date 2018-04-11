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

    }

    /**
     * @Route("/events/{slug}", name="eventSpecific")
     */
    public function event($slug)
    {

    }

    /**
     * @Route("/events/add", name="addEvent")
     */
    public function add()
    {

    }
}