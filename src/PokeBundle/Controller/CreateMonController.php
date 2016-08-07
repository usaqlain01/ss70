<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 8/6/16
 * Time: 8:36 PM
 */

namespace PokeBundle\Controller;

use AppBundle\Controller\BasePokeController;
use PokeBundle\Entity\PokeKind;
use PokeBundle\Entity\Pokemon;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CreateMonController extends BasePokeController
{
    /**
     * @Route("/pikachu/{id}", name="poster_show")
     * @param PokeKind $pokeKind
     */
    public function createMonByKind(PokeKind $pokeKind)
    {
        $em = $this->getDoctrine()->getManager();
        $yourMon = new Pokemon($pokeKind);
        $em->persist($yourMon);
        $em->flush();

        return $this->render('pokemon/poke_test_drive.html.twig',[
            'pokemon' => $yourMon,
        ]);

    }
}