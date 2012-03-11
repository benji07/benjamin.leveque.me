<?php

namespace Benji07\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Benji07\BlogBundle\Entity\Post;

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
            ->add('status', null, array('label' => 'Statut'))
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