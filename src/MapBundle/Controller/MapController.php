<?php

/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/30/16
 * Time: 12:32 PM
 */

namespace MapBundle\Controller;

use AppBundle\Controller\BaseMapController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MapController extends BaseMapController
{
    /**
     * @Route("/maptest", name="maptest")
     */
    public function testMapAction()
    {
        return $this->render('test.html.twig',[
            'message' => 'BUNDLE + CONTROLLER IS HOOKED UP',
        ]);
    }

    /**
     * @Route("/randommap", name="randommap")
     */
    public function randomMapsAction()
    {
        return $this->render('maps/randommap.html.twig',[
            'lat' => mt_rand(-85,85),
            'lon' => mt_rand(-180,180),
        ]);
    }

    /**
     * @Route("/custommap", name="custommap")
     */
    public function customMapAction()
    {
        return $this->render('maps/custommap.html.twig', [
            'message' => 'HELLOW CUSTOM MAp',
        ]);
    }
}