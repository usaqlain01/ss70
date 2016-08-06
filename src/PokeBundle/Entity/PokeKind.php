<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 8/5/16
 * Time: 10:39 AM
 */

namespace PokeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="poke_kind")
 */
class PokeKind
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $pokeDexId;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="PokeBundle\Entity\PokeType", inversedBy="pokeKinds")
     */
    protected $pokeTypes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $storyLine;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $evolvesInto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $evolvesFrom;

    /**
     * @ORM\Column(type="array")
     */
    protected $tips;

    /**
     * @ORM\Column(type="array")
     */
    protected $comments;

    /**
     * @return integer
     */
    public function getPokeDexId()
    {
        return $this->pokeDexId;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getPokeTypes()
    {
        return $this->pokeTypes;
    }

    /**
     * @param PokeType|ArrayCollection $pokeTypes
     */
    public function setPokeTypes($pokeTypes)
    {
        if(is_array($pokeTypes)) {
            foreach($pokeTypes as $pokeType) {
                if(!$this->pokeTypes->contains($pokeType)) {
                    $this->pokeTypes->add($pokeType);
                }
            }
        } elseif ($pokeTypes) {
            if(!$this->pokeTypes->contains($pokeTypes)) {
                $this->pokeTypes->add($pokeTypes);
            }
        } else {
            //bad request.
        }
    }

    /**
     * @return mixed
     */
    public function getStoryLine()
    {
        return $this->storyLine;
    }

    /**
     * @param mixed $storyLine
     */
    public function setStoryLine($storyLine)
    {
        $this->storyLine = $storyLine;
    }

    /**
     * @return integer
     */
    public function getEvolvesInto()
    {
        return $this->evolvesInto;
    }

    /**
     * @param integer $evolvesInto
     */
    public function setEvolvesInto($evolvesInto)
    {
        $this->evolvesInto = $evolvesInto;
    }

    /**
     * @return integer
     */
    public function getEvolvesFrom()
    {
        return $this->evolvesFrom;
    }

    /**
     * @param integer $evolvesFrom
     */
    public function setEvolvesFrom($evolvesFrom)
    {
        $this->evolvesFrom = $evolvesFrom;
    }

    /**
     * @return mixed
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * @param mixed $tips
     */
    public function setTips($tips)
    {
        $this->tips = $tips;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @todo turn into objects
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }


}