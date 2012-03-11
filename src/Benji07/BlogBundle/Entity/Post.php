<?php

namespace Benji07\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Benji07\BlogBundle\Entity\Post
 *
 * @ORM\Table(name="sf2_post")
 * @ORM\Entity(repositoryClass="Benji07\BlogBundle\Entity\PostRepository")
 */
class Post
{
    const STATUS_DRAFT = 0;
    CONST STATUS_PUBLISHED = 1;

    const COMMENT_STATUS_OPEN = 0;
    const COMMENT_STATUS_LIMIT = 1;
    const COMMENT_STATUS_CLOSE = 2;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @var smallint $status
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status = self::STATUS_DRAFT;

    /**
     * @var smallint $commentStatus
     *
     * @ORM\Column(name="comment_status", type="smallint")
     */
    private $commentStatus = self::COMMENT_STATUS_OPEN;

    /**
     * @var datetime $publishedAt
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field="status", value="1")
     */
    private $publishedAt;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var ArrayCollection $comments
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private $comments;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set content
     *
     * @param text $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return text
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set status
     *
     * @param smallint $status
     *
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return smallint
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set commentStatus
     *
     * @param smallint $commentStatus
     *
     * @return Post
     */
    public function setCommentStatus($commentStatus)
    {
        $this->commentStatus = $commentStatus;

        return $this;
    }

    /**
     * Get commentStatus
     *
     * @return smallint
     */
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * Set publishedAt
     *
     * @param datetime $publishedAt
     *
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return datetime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param datetime $updatedAt
     *
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set comments
     *
     * @param ArrayCollection $comments
     *
     * @return Post
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get Comments
     *
     * @return ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * __toString
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * Get available status for post
     *
     * @return array
     */
    public static function getAvailableStatus()
    {
        return array(
            self::STATUS_DRAFT     => 'Brouillon',
            self::STATUS_PUBLISHED => 'Publié'
        );
    }

    /**
     * Get available status for comment
     *
     * @return array
     */
    public static function getAvailableCommentStatus()
    {
        return array(
            self::COMMENT_STATUS_OPEN  => 'Ouvert',
            self::COMMENT_STATUS_LIMIT => 'Limité',
            self::COMMENT_STATUS_CLOSE => 'Fermé'
        );
    }
}