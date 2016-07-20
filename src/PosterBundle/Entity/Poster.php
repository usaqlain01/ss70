<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/9/16
 * Time: 6:44 PM
 */

namespace PosterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="PosterBundle\Repository\PosterRepository")
 * @ORM\Table(name="poster")
 */
class Poster
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_published;

    /**
     * @ORM\Column(type="string")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $positionsCount;

    /**
     * @ORM\ManyToOne(targetEntity="PosterBundle\Entity\PosterLocation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="PosterBundle\Entity\PosterReply", mappedBy="poster")
     * @ORM\OrderBy({"createdAt"="DESC"})
     */
    private $replies;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $event_date;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getPositionsCount()
    {
        return $this->positionsCount;
    }

    /**
     * @param mixed $positionsCount
     */
    public function setPositionsCount($positionsCount)
    {
        $this->positionsCount = $positionsCount;
    }

    /**
     * @return boolean
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * @param boolean $is_published
     */
    public function setIsPublished($is_published)
    {
        $this->is_published = $is_published;
    }

    /**
     * @return ArrayCollection|PosterReply[]
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * @return PosterLocation
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param PosterLocation $location
     */
    public function setLocation(PosterLocation $location)
    {
        $this->location = $location;
    }


    public function getEventDate()
    {
        return $this->event_date;
    }


    public function setEventDate(\DateTime $event_date=null)
    {
        $this->event_date = $event_date;
    }


    
}