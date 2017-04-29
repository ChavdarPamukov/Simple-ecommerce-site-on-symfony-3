<?php

namespace EcommerceBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Category controller.
 *
 * @Route("admin")
 */
class HomeAdminController extends Controller
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="dashboard_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('EcommerceBundle:Categories')->findAll();

        return $this->render('admin/home.html.twig', array(
            'categories' => $categories,
        ));
    }
}
