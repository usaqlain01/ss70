<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/9/16
 * Time: 12:12 PM
 */

namespace PosterBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PosterController
{
    /**
     * @Route("/poster")
     */
    public function showAction()
    {
        return new Response('WHAT AN AMAZING POSTER');
    }
}