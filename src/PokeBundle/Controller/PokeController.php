<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 8/5/16
 * Time: 8:35 AM
 */

namespace PokeBundle\Controller;


use AppBundle\Controller\BasePokeController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PokeController extends BasePokeController
{
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
        $em = $this->getDoctrine()->getManager();

        $pokeCreateService = $this->get('app.poke.kind_generator');

        $pokeTypes = $pokeCreateService->createPokeTypes();
        $message = array();

        foreach($pokeTypes as $pokeType){
            $em->persist($pokeType);
            $message[] = $pokeType;
        }
        $em->flush();

        return $this->render('pokemon/pokeTest.html.twig', [
            'result' => $message,
        ]);
    }

    /**
     * @Route("/pokemon-kind-create", name="pokeKindCreate")
     */
    public function pokeKindsCreate()
    {
        $result = 'dont know right now';
        return $this->render('pokemon/pokeTest.html.twig', [
            'result' => $result,
        ]);
    }
}