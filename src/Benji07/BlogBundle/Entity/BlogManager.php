<?php

namespace Benji07\BlogBundle\Entity;

use Doctrine\ORM\EntityManager,
    Knp\Component\Pager\Paginator;

/**
 * Blog Manager
 *
 * @author Benjamin Lévêque <benjamin@leveque.me>
 */
class BlogManager
{
    private $entityManager;

    private $paginator;

    private $perPage = 10;

    /**
     * @param EntityManager $entityManager entityManager
     * @param Paginator     $paginator     paginator
     */
    public function __construct(EntityManager $entityManager, Paginator $paginator)
    {
        $this->entityManager = $entityManager;
        $this->paginator = $paginator;
    }

    /**
     * Get Post Pager
     *
     * @param integer $page the current page
     * @param Tag     $tag  a tag
     *
     * @return Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getPostPager($page = 1, Tag $tag = null)
    {
        $query = null;

        if ($tag) {
            $query = $this->getQueryForTag($tag);
        } else {
            $query = $this->getQuery();
        }

        return $this->paginator->paginate($query, $page, $this->perPage);
    }

    /**
     * Get Query for tag
     *
     * @param Tag $tag a tag
     *
     * @return Doctrine\ORM\Query
     */
    protected function getQueryForTag(Tag $tag)
    {
        return $this->getRepository()->getPublishedQueryForTag($tag);
    }

    /**
     * Get Query for tag
     *
     * @return Doctrine\ORM\Query
     */
    public function getQuery()
    {
        return $this->getRepository()->getPublishedQuery();
    }

    /**
     * Update the tags for a post from tags string
     *
     * @param Post $post post
     */
    public function updateTags(Post $post)
    {
        $string = $post->getTagsString();
        $post->getTags()->clear();

        $tags = explode(',', $string);

        foreach ($tags as $tag) {
            $tag = trim($tag);

            if ('' === $tag) {
                continue;
            }

            $t = $this->getTagRepository()->findOneBy(array('name' => $tag));

            if (null === $t) {
                $t = new Tag();
                $t->setName($tag);

                $this->getEntityManager()->persist($t);
            }

            $post->getTags()->add($t);
        }
    }

    /**
     * Get Entitymanager
     *
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Get Post respository
     *
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->getEntityManager()->getRepository('Benji07BlogBundle:Post');
    }

    /**
     * Get the tag repository
     *
     * @return EntityRepository
     */
    protected function getTagRepository()
    {
        return $this->getEntityManager()->getRepository('Benji07BlogBundle:Tag');
    }
}
