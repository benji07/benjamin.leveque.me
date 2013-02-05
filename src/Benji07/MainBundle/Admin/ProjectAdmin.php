<?php

namespace Benji07\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin,
    Sonata\AdminBundle\Form\FormMapper,
    Sonata\AdminBundle\Datagrid\ListMapper;

/**
 * Project Admin
 */
class ProjectAdmin extends Admin
{
    protected $baseRoutePattern = '/project';

    /**
     * Configuration de la liste
     *
     * @param ListMapper $listMapper la description de la liste
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label' => 'Titre'))
            ->add('createdAt', null, array('label' => 'Ajouté le'))
            ->add('active')
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
            ->add('description', null, array('required' => false))
            ->add('file', 'file', array('required' => false))
            ->add('active', null, array('required' => false))
            ->add('createdAt', null, array('required' => false));
    }

    /**
     * Get Upload path
     *
     * @return string
     */
    public function getUploadPath()
    {
        return $this->uploadedPath;
    }

    /**
     * Set upload path
     *
     * @param string $path path
     */
    public function setUploadPath($path)
    {
        $this->uploadedPath = $path;
    }

    /**
     * Pre update
     *
     * @param object $object object
     */
    public function preUpdate($object)
    {
        $object->uploadPicture($this->getUploadPath());
    }

    /**
     * Pre persist
     *
     * @param object $object object
     */
    public function prePersist($object)
    {
        $object->uploadPicture($this->getUploadPath());
    }
}
