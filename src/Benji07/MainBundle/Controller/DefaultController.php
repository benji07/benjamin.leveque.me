<?php

namespace Benji07\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\Security\Core\SecurityContext;

/**
 * Main Bundle Default Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/veille", name="veille")
     * @Template()
     *
     * @return array
     */
    public function veilleAction()
    {
        $r = $this->getDoctrine()->getEntityManager()->getRepository('Benji07MainBundle:Link');

        $qb = $r->createQueryBuilder('l');
        $qb->orderBy('l.createdAt', 'DESC');

        $page = $this->getRequest()->query->get('page', 1);

        $pagination = $this->get('knp_paginator')->paginate($qb, $page, 20);

        return array('pagination' => $pagination);
    }

    /**
     * @Route("/about", name="about")
     * @Template
     *
     * @return array
     */
    public function aboutAction()
    {
        $r = $this->getDoctrine()->getEntityManager()->getRepository('Benji07MainBundle:Project');

        $projects = $r->findBy(array('active' => true), array('createdAt' => 'DESC'));

        return array('projects' => $projects);
    }

    /**
     * Login action
     *
     * @Route("/admin/login", name="login")
     * @Template()
     *
     * @return array
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        );
    }

    /**
     * Login check action
     *
     * @Route("/admin/login_check", name="login_check")
     *
     * @return void
     */
    public function loginCheckAction()
    {
    }

    /**
     * Login action
     *
     * @Route("/admin/logout", name="logout")
     *
     * @return void
     */
    public function logout()
    {
    }
}
