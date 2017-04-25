<?php

namespace EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopCategoriesController extends Controller
{
    public function indexAction()
    {
        return $this->render('', array('name' => $name));
    }
}
