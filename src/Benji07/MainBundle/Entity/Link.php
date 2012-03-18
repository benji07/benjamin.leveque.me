<?php

namespace Benji07\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Benji07\MainBundle\Entity\Link
 *
 * @ORM\Table(name="sf2_link")
 * @ORM\Entity
 */
class Link
{
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
     */
    private $title;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var integer $tumblrId
     *
     * @ORM\Column(name="tumblr_id", type="bigint")
     */
    private $tumblrId;
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
     * @return Link
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
     * Set url
     *
     * @param string $url
     *
     * @return Link
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     *
     * @return Link
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
     * Set tumblr id
     *
     * @param integer $tumblrId
     *
     * @return Link
     */
    public function setTumblrId($tumblrId)
    {
        $this->tumblrId = $tumblrId;

        return $this;
    }

    /**
     * Get tumblrId
     *
     * @return integer
     */
    public function getTumblrId()
    {
        return $this->tumblrId;
    }

    /**
     * __String
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }
}