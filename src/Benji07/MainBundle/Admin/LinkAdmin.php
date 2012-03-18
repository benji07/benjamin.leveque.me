<?php

namespace Benji07\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Link Admin
 */
class LinkAdmin extends Admin
{
    protected $baseRoutePattern = '/link';

    /**
     * Configuration de la liste
     *
     * @param ListMapper $listMapper la description de la liste
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Titre'))
            ->add('url')
            ->add('createdAt', null, array('label' => 'Ajouté le'))
            ->add('_action', 'actions', array(
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
            ->add('title')
            ->add('url')
            ->add('createdAt');
    }
}