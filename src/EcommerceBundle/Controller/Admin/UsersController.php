<?php

namespace EcommerceBundle\Controller\Admin;

use EcommerceBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("admin/users")
 */
class UsersController extends Controller
{
    /**
     * Lists all user entities.
     *
     * @Route("/", name="admin_users_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('EcommerceBundle:Users')->findAll();

        return $this->render('admin/users/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a user entity in edit.
     *
     * @Route("/{id}", name="admin_users_edit_show")
     * @Method("GET")
     */
    public function editShowUserAction(Users $user)
    {
        return $this->render('admin/users/show.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="admin_users_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Users $user)
    {
        $editForm = $this->createForm('EcommerceBundle\Form\UsersType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'User edited successfully!');

            return $this->redirectToRoute('admin_users_index', array('id' => $user->getId()));
        }

        return $this->render('admin/users/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="admin_users_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Users $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'User deleted successfully!');

        return $this->redirectToRoute('admin_users_index');
    }
}
