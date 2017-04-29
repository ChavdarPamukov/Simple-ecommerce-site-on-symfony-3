<?php

namespace EcommerceBundle\Controller;

use EcommerceBundle\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="user_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error
        ));
    }

    /**
     * @Route("/register", name="user_register")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $form = $this->createForm('EcommerceBundle\Form\RegisterType');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* @var Users $user */
            $user = $form->getData();

            $encoder = $this->get('security.password_encoder');

            $user->setPassword(
                $encoder->encodePassword($user, $user->getPasswordRaw())
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('products_index');
        }

        return $this->render('security/register.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/logout", name="user_logout")
     */
    public function logoutAction()
    {
    }
}
