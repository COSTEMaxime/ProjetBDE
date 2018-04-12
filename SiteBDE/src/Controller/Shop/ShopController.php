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
        return $this->render('/Shop/shop.html.twig');
    }

    /**
     * @Route("/shop/article/{slug}", name="articleSpecific")
     */
    public function article($slug)
    {
        return $this->render('/Shop/article.html.twig');
    }

    /**
     * @Route("/shop/cart", name="cart")
     */
    public function cart()
    {
        return $this->render('/Shop/cart.html.twig');
    }

    /**
     * @Route("/shop/admin", name="manageShop")
     */
    public function manage()
    {
        return $this->render('/Shop/gestion.html.twig');
    }
}