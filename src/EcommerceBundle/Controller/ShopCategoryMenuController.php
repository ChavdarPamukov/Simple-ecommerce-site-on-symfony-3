<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopCategoryMenuController extends Controller
{
    public function menuCategoriesAction()
    {

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('EcommerceBundle:Categories')->findAll();

        return $this->render('shop/_categories_menu.html.twig', array(
            'categories' => $categories,
        ));
    }
}
