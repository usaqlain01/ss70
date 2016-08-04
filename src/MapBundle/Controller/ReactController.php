<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 8/3/16
 * Time: 7:58 PM
 */

namespace MapBundle\Controller;


use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ReactController extends BaseController
{


    /**
     * @Route("/react-first-page"), name="react-test"
     *
     *
     * @return Response
     */
    public function firstAction()
    {
        return $this->render('react/first.html.twig', [
            'message' => 'Success',
        ]);

    }
}