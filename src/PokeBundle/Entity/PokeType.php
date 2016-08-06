<?php

namespace PokeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity()
 * @ORM\Table(name="poke_types")
 */
class PokeType
{
    const TYPE_BUG = 'bug';
    const TYPE_GRASS = 'grass';
    const TYPE_DARK = 'dark';
    const TYPE_GROUND = 'ground';
    const TYPE_DRAGON = 'dragon';
    const TYPE_ICE = 'ice';
    const TYPE_FAIRY = 'fairy';
    const TYPE_POISON = 'poison';
    const TYPE_FIGHTING = 'fighting';
    const TYPE_PSYCHIC = 'psychic';
    const TYPE_FIRE = 'fire';
    const TYPE_ROCK = 'rock';
    const TYPE_FLYING = 'flying';
    const TYPE_STEEL = 'steel';
    const TYPE_GHOST = 'ghost';
    const TYPE_WATER = 'water';
    const TYPE_NORMAL = 'normal';
    const TYPE_ELECTRIC = 'electric';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="array")
     */
    protected $strongOffense = array();

    /**
     * @ORM\Column(type="array")
     */
    protected $weakOffense = array();

    /**
     * @ORM\Column(type="array")
     */
    protected $strongDefense = array();

    /**
     * @ORM\Column(type="array")
     */
    protected $weakDefense = array();


    public function __construct($name, array $strongOffense, array $weakOffence, array $strongDefence, array $weakDefence)
    {
        if($name){
            $this->setName($name);
        }
        if(is_array($strongOffense)) {
            $this->setStrongOffense($strongOffense);
        }
        if(is_array($weakOffence)) {
            $this->setWeakOffense($weakOffence);
        }
        if(is_array($strongDefence)) {
            $this->setStrongDefense($strongDefence);
        }
        if(is_array($weakDefence)) {
            $this->setWeakDefense($weakDefence);
        }
        return $this;
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
     * @return array
     */
    public function getStrongOffense()
    {
        return $this->strongOffense;
    }

    /**
     * @param array $strongOffense
     */
    public function setStrongOffense($strongOffense = array())
    {
        foreach($strongOffense as $offense) {
            if(!in_array($offense, $this->strongOffense)) {
                $this->strongOffense[] = $offense;
            }
        }
    }

    /**
     * @return array
     */
    public function getWeakOffense()
    {
        return $this->weakOffense;
    }

    /**
     * @param array $weakOffense
     */
    public function setWeakOffense($weakOffense=array())
    {
        foreach($weakOffense as $offense) {
            if(!in_array($offense, $this->weakOffense)) {
                $this->weakOffense[] = $offense;
            }
        }
    }

    /**
     * @return array
     */
    public function getStrongDefense()
    {
        return $this->strongDefense;
    }

    /**
     * @param array $strongDefense
     */
    public function setStrongDefense($strongDefense=array())
    {
        foreach($strongDefense as $defense) {
            if(!in_array($defense, $this->strongDefense)) {
                $this->strongDefense[] = $defense;
            }
        }
    }

    /**
     * @return array
     */
    public function getWeakDefense()
    {
        return $this->weakDefense;
    }

    /**
     * @param array $weakDefense
     */
    public function setWeakDefense($weakDefense=array())
    {
        foreach($weakDefense as $defense) {
            if(!in_array($defense, $this->weakDefense)) {
                $this->weakDefense[] = $defense;
            }
        }
    }

}