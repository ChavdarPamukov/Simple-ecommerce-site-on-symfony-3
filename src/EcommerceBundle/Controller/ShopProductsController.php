<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Product controller.
 *
 * @Route("/products")
 */
class ShopProductsController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="products_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('EcommerceBundle:Products')
            ->findBy([], ['id'=>'desc']);

        return $this->render('shop/products/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="products_show")
     * @Method("GET")
     */
    public function showAction(Products $product)
    {
        return $this->render('shop/products/show.html.twig', array(
            'product' => $product,
        ));
    }
}
