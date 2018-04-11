<?php

namespace App\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends Controller
{
    /**
     * @Route("/shop", name="shop")
     */
    public function shopHomepage()
    {

    }

    /**
     * @Route("/shop/article/{slug}", name="articleSpecific")
     */
    public function article($slug)
    {

    }

    /**
     * @Route("/shop/cart", name="cart")
     */
    public function cart()
    {

    }

    /**
     * @Route("/shop/admin", name="manageShop")
     */
    public function manage()
    {

    }
}