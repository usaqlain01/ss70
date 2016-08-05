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
}