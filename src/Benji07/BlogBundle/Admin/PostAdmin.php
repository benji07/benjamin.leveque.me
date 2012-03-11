<?php

namespace Benji07\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

use Benji07\BlogBundle\Entity\Post;

/**
 * Post Admin
 */
class PostAdmin extends Admin
{
    /**
     * The base route pattern used to generate the routing information
     *
     * @var string
     */
    protected $baseRoutePattern = '/post';

    /**
     * Configuration de la liste
     *
     * @param ListMapper $listMapper la description de la liste
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Titre'))
            ->add('status', null, array('label' => 'Statut', 'template' => 'Benji07BlogBundle:PostAdmin:status.html.twig'))
            ->add('publishedAt', null, array('label' => 'Publié le'))
            ->add('_action', 'actions', array(
                'name' => 'Actions',
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * Configuration du formulaire
     *
     * @param FormMapper $formMapper la description du formulaire
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Général')
                ->add('title', null, array(
                    'label' => 'Titre'
                ))
                ->add('content', null, array(
                    'label' => 'Contenu'
                ))
            ->end()
            ->with('Options')
                ->add('status', 'choice', array(
                    'label' => 'Statut',
                    'choices' => Post::getAvailableStatus()
                ))
                ->add('commentStatus', 'choice', array(
                    'label' => 'Commentaires',
                    'choices' => Post::getAvailableCommentStatus()
                ))
            ->end();
    }
}