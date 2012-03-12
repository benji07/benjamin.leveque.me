<?php

namespace Benji07\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Show\ShowMapper;

/**
 * Tag Admin
 */
class TagAdmin extends Admin
{
    protected $baseRoutePattern = '/tag';

    /**
     * Configuration de la liste
     *
     * @param ListMapper $listMapper la description de la liste
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name', null, array('label' => 'Nom'))
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
            ->add('name', null, array(
                'label' => 'Nom'
            ));
    }
}