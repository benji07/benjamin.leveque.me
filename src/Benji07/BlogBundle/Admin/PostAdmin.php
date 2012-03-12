<?php

namespace Benji07\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Datagrid\ListMapper,
    Sonata\AdminBundle\Show\ShowMapper;

use Benji07\BlogBundle\Entity\Post;

use Doctrine\ORM\EntityManager;

/**
 * Post Admin
 */
class PostAdmin extends Admin
{
    protected $baseRoutePattern = '/post';

    private $entityManager;

    /**
     * Set EntityManager
     *
     * @param EntityManager $entityManager entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Configuration de la liste
     *
     * @param ListMapper $listMapper la description de la liste
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Titre'))
            ->add('tags')
            ->add('status', null, array('label' => 'Statut', 'template' => 'Benji07BlogBundle:PostAdmin:list_status.html.twig'))
            ->add('publishedAt', null, array('label' => 'Publié le'))
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
                ->add('tagsString', 'text', array(
                    'required' => false,
                    'label' => 'Tags'
                ))
                ->add('tags')
                ->add('status', 'choice', array(
                    'label' => 'Statut',
                    'choices' => Post::getAvailableStatus()
                ))
            ->end();
    }

    /**
     * Configuration de la page show
     *
     * @param ShowMapper $filter filter
     */
    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('title', null, array('label' => 'Titre'))
            ->add('status', null, array(
                'label' => 'Statut',
                'template' => 'Benji07BlogBundle:PostAdmin:show_status.html.twig'
            ))
            ->add('createdAt', null, array('label' => 'Crée le'))
            ->add('publishedAt', null, array('label' => 'Publié le'))
            ->add('tags', null, array('label' => 'Tags'))
            ->add('content', null, array(
                'label' => 'Contenu',
                'template' => 'Benji07BlogBundle:PostAdmin:show_content.html.twig'
            ));
    }

    /**
     * Trigger on preUpdate
     *
     * @param Post $object post
     */
    public function preUpdate($object)
    {
        $this->preSave($object);
    }

    /**
     * Trigger on prePersist
     *
     * @param Post $object post
     */
    public function prePersist($object)
    {
        $this->preSave($object);
    }

    /**
     * preSave
     *
     * @param Post $object post
     */
    public function preSave($object)
    {
        $repository = $this->entityManager->getRepository($this->getClass());

        $repository->updateTags($object);
    }
}