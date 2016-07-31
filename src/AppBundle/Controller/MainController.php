<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }

    /**
     * @Route("/bg", name="home0")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bkbAction()
    {
        return $this->render('bg/bkb.html.twig');
    }

    /**
     * @Route("/bg1", name="home1")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bkgAction()
    {
        return $this->render('bg/bkg.html.twig');
    }

    /**
     * @Route("/bg2", name="home2")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bklAction()
    {
        return $this->render('bg/bkl.html.twig');
    }

    /**
     * @Route("/bg3", name="home3")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function bkwAction()
    {
        return $this->render('bg/bkw.html.twig');
    }
}