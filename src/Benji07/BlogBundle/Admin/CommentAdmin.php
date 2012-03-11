<?php

namespace Benji07\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Benji07\BlogBundle\Entity\Comment;

/**
 * Classe pour générer l'admin sur les commentaires
 */
class CommentAdmin extends Admin
{
    protected $baseRoutePattern = '/comment';

    /**
     * Configuration de la liste
     *
     * @param ListMapper $listMapper a list mapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('post', null, array('label' => 'Article'))
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('status', null, array('label' => 'Statut', 'template' => 'Benji07BlogBundle:CommentAdmin:list_status.html.twig'))
            ->add('createdAt', null, array('label' => 'Crée le'))
            ->add('_action', 'actions', array(
                'name' => 'Actions',
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    /**
     * Configuration de la page show
     *
     * @param ShowMapper $filter filter
     */
    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('post', null, array('label' => 'Article'))
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('email', null, array('label' => 'Email'))
            ->add('avatar', null, array(
                'label' => 'Avatar',
                'template' => 'Benji07BlogBundle:CommentAdmin:show_avatar.html.twig'
            ))
            ->add('createdAt', null, array('label' => 'Ajouté le'))
            ->add('status', null, array(
                'label' => 'Status',
                'template' => 'Benji07BlogBundle:CommentAdmin:show_status.html.twig'
            ))
            ->add('content', null, array('label' => 'Commentaire'));
    }

    /**
     * Configuration du formulaire
     *
     * @param FormMapper $formMapper la description du formulaire
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', null, array('label' => 'Pseudo'))
            ->add('email', null, array('label' => 'Email'))
            ->add('status', 'choice', array(
                'label' => 'Statut',
                'choices' => Comment::getAvailableStatus()
            ))
            ->add('content', null, array('label' => 'Commentaire'));
    }

    /**
     * On enlève les routes que l'on n'utilise pas
     */
    public function buildRoutes()
    {
        parent::buildRoutes();

        $this->routes->remove('create');
    }

    /**
     * On enlève les actions batchs
     *
     * @return array
     */
    public function getBatchActions()
    {
        return array();
    }
}