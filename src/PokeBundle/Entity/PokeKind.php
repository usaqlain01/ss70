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
    const TOTAL = 151;
    
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
     * @ORM\ManyToMany(targetEntity="PokeBundle\Entity\PokeType", mappedBy="pokeKinds")
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
     * @ORM\Column(type="array", nullable=true)
     */
    protected $tips;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    protected $comments;

    public function __construct($dexId, $name, array $pokeTypes, $storyLine=null, $evolvesInto=null, $evolvesFrom=null)
    {
        $this->pokeTypes = new ArrayCollection();
        $this->pokeDexId = $dexId;
        $this->name = $name;

        if($pokeTypes) {
            if(is_array($pokeTypes)) {
                foreach($pokeTypes as $type) {
                    $this->addPokeType($type);
                }
            } else {
                $this->addPokeType($pokeTypes);
            }
        }

        if($storyLine){
            $this->storyLine = $storyLine;
        }
        if($evolvesInto){
            $this->evolvesInto = $evolvesInto;
        }
        if($evolvesFrom){
            $this->evolvesFrom = $evolvesFrom;
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getPokeTypes()
    {
        return $this->pokeTypes;
    }

    public function getPokeTypesArray()
    {
        return $this->pokeTypes->toArray();
    }

    /**
     * @param PokeType $type
     */
    public function addPokeType(PokeType $type)
    {
        if(!$this->pokeTypes->contains($type)){
            $this->pokeTypes->add($type);
        }
    }

    public function removePokeType(PokeType $type)
    {
        if($this->pokeTypes->contains($type)){
            $this->pokeTypes->removeElement($type);
        }
    }

    /**
     * @return integer
     */
    public function getPokeDexId()
    {
        return $this->pokeDexId;
    }

    /**
     * @param int $pokeDexId
     */
    public function setPokeDexId($pokeDexId)
    {
        $this->pokeDexId = $pokeDexId;
    }


    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
}