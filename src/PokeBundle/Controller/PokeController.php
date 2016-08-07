<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 8/5/16
 * Time: 8:35 AM
 */

namespace PokeBundle\Controller;


use AppBundle\Controller\BasePokeController;
use PokeBundle\Entity\PokeKind;
use PokeBundle\Entity\PokeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PokeController extends BasePokeController
{
    const FULL = 'Table is full';
    const ROOM = 'Table has room';
    const EMPTY = 'Table is empty';

    /**
     * @Route("/pokemon", name="pokeTest")
     */
    public function testPokemon()
    {
        return $this->render('pokemon/pokeTest.html.twig', [
            'result' => 'WELCOME TO POKE PLANET!!!!!!! PIKA PIKA',
        ]);
    }

    /**
     * @Route("/pokemon-type-create", name="pokeTypeCreate")
     */
    public function pokeTypesCreate()
    {
        if($this->pokeTypesStatus() != self::FULL) {
            $em = $this->getDoctrine()->getManager();

            $pokeCreateService = $this->get('app.poke.kind_generator');

            $pokeTypes = $pokeCreateService->createPokeTypes();
            $message = array();

            foreach($pokeTypes as $pokeType){
                $em->persist($pokeType);
                $message[] = $pokeType;
            }
            $em->flush();
        } else {
            $message = 'Maximum Pokemon Types Already Exist';
        }
        
        return $this->render('pokemon/pokeTest.html.twig', [
            'result' => $message,
        ]);
    }

    /**
     * @Route("/pokemon-kind-create", name="pokeKindCreate")
     */
    public function pokeKindsCreate()
    {
        if($this->pokeKindsStatus() != self::FULL) {
            $em = $this->getDoctrine()->getManager();
            $pokeCreateService = $this->get('app.poke.kind_generator');

            $pokeKinds = $pokeCreateService->createPokeKinds();

            $kindsCreated = [];

            foreach($pokeKinds as $index => $pokeKind)
            {
                $pokeTypeObjects = [];
                foreach($pokeKind['type'] as $pType){
                    $pokeTypeObjects[] = $em->getRepository('PokeBundle:PokeType')->findOneBy(array('name' => $pType));
                }
                //public function __construct($dexId, $name, array $pokeTypes, $storyLine=null, $evolvesInto=null, $evolvesFrom=null, $tips=null, $comments=null)
                $kindsCreated[] = new PokeKind($index, $pokeKind['name'], $pokeTypeObjects, $pokeKind['story'], $pokeKind['to'], $pokeKind['from'], 'coming soon', 'add');
            }

            foreach($kindsCreated as $pokeKind){
                $em->persist($pokeKind);
                $message[] = $pokeKind;
            }
            $em->flush();
        } else {
            $message = 'Maximum Pokemon Kinds Already Exist';
        }

        return $this->render('pokemon/pokeTest.html.twig', [
            'result' => $message,
        ]);
    }
    
    public function pokeTypesStatus()
    {
        $em = $this->getDoctrine()->getManager();
        $ourTypeCount = count($em->getRepository('PokeBundle:PokeType')->findAll());
        $expTypeCount = PokeType::TOTAL;

        $result =
            $ourTypeCount === 0 ? self::EMPTY
            : ($ourTypeCount < $expTypeCount)
            ? self::ROOM : self::FULL
            ;
        return $result;
        
    }
    public function pokeKindsStatus()
    {
        $em = $this->getDoctrine()->getManager();
        $ourKindCount = count($em->getRepository('PokeBundle:PokeKind')->findAll());
        $expKindCount = PokeKind::TOTAL;

        $result =
            $ourKindCount === 0 ? self::EMPTY
            : ($ourKindCount < $expKindCount)
            ? self::ROOM : self::FULL
        ;
        return $result;
    }

    /**
     * @Route("/poke-kind/type/{id}", name="poke_kind_by_type")
     */
    public function pokeDexByTypes()
    {

    }

    /**
     * @Route("/poke-kind/kind/{id}", name="poke_kind_by_kind")
     */
    public function pokeDexById()
    {

    }

    /**
     * @Route("/pokedex", name="pokedex")
     */
    public function pokeDexALL()
    {
        $pokmons = $this->getDoctrine()->getManager()->getRepository('PokeBundle:PokeKind')->findAll();
        return $this->render('pokemon/pokeList.html.twig',[
            'items' => $pokmons,
        ]);
        
    }





}