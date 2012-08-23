<?php

namespace Benji07\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Benji07\BlogBundle\Entity\Post;
use Benji07\BlogBundle\Entity\Tag;

/**
 * Benji07BlogBundle DefaultController
 *
 * @author Benjamin Lévêque <benjamin@leveque.me>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Route("/rss.xml", name="blog_rss", defaults={"_format"="rss"})
     * @Template
     * @Cache(public=true, expires="1 day")
     *
     * @return array()
     */
    public function indexAction()
    {
        $page = $this->getRequest()->query->get('page', 1);

        $pagination = $this->getManager()->getPostPager($page);

        return array('pagination' => $pagination);
    }

    /**
     * Show a Post
     *
     * @param Post $post a published post
     *
     * @Route("/{slug}.html", name="blog_show", defaults={"status" = 1})
     * @Template
     * @Cache(public=true, expires="1 day")
     *
     * @return array
     */
    public function showAction(Post $post)
    {
        return array('post' => $post);
    }

    /**
     * List of post for a tag
     *
     * @param Tag $tag tag
     *
     * @Route("/tags/{slug}.html", name="blog_tag")
     * @Route("/tags/{slug}.xml", name="blog_tag_rss", defaults={"_format"="rss"})
     * @Template
     * @Cache(public=true, expires="1 day")
     *
     * @return array
     */
    public function tagAction(Tag $tag)
    {
        $page = $this->getRequest()->query->get('page', 1);

        $pagination = $this->getManager()->getPostPager($page, $tag);

        return array('tag' => $tag, 'pagination' => $pagination);
    }

    /**
     * Get Manager
     *
     * @return BlogManager
     */
    protected function getManager()
    {
        return $this->get('benji07_blog.manager');
    }
}
