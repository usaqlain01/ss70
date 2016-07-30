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
}