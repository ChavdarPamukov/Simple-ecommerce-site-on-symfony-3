<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('shop/products/index.html.twig', [
            "products" => $this->getDoctrine()->getRepository(Products::class)
                ->findBy([], ['id'=>'desc'])
        ]);
    }
}
