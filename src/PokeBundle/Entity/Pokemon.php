<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 8/6/16
 * Time: 8:03 PM
 */

namespace PokeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pokemon")
 */
class Pokemon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="PokeBundle\Entity\PokeKind")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pokeKind;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $cp;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $hp;

    /**
     * Pokemon constructor.
     */
    public function __construct(PokeKind $pokeKind)
    {
        $this->pokeKind = $pokeKind;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return PokeKind
     */
    public function getPokeKind()
    {
        return $this->pokeKind;
    }

    public function setPokeKind(PokeKind $pokeKind)
    {
        $this->pokeKind = $pokeKind;
    }

    /**
     * @return mixed
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * @param mixed $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @return int
     */
    public function getHp()
    {
        return $this->hp;
    }

    /**
     * @param int $hp
     */
    public function setHp($hp)
    {
        $this->hp = $hp;
    }
}