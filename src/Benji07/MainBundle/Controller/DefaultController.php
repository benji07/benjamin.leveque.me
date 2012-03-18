<?php

namespace Benji07\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
        return array();
    }
}
