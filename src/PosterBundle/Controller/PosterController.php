<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/9/16
 * Time: 12:12 PM
 */

namespace PosterBundle\Controller;


use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PosterController extends BaseController
{
    /**
     * @Route("/poster/{id}")
     */
    public function showAction($id)
    {
        $twig = $this->get('templating');
        $html = $twig->render('poster/show.html.twig', [
            'id' => $id,
        ]);

        return new Response($html);
    }
}