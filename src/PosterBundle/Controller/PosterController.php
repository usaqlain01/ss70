<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/9/16
 * Time: 12:12 PM
 */

namespace PosterBundle\Controller;


use AppBundle\Controller\BaseController;
use PosterBundle\Entity\Poster;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PosterController extends BaseController
{
    /**
     * @Route("/poster/new")
     */
    public function newAction()
    {
        $poster = new Poster();
        $poster->setTitle('Need Base Player'.rand(1,1000));
        $poster->setCategory('Sports');
        $poster->setPositionsCount(3);
        $em = $this->getDoctrine()->getManager();
        $em->persist($poster);
        $em->flush();

        return new Response('<html><body>POSTER CREATED</body></html>');
    }

    /**
     * @Route("/posters")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posters = $em->getRepository('PosterBundle:Poster')->findAll();
        
        return $this->render('poster/list.html.twig',[
            'posters' => $posters,
        ]);
    }
    
    /**
     * @Route("/poster/{id}")
     */
    public function showAction($id)
    {
        $testText = 'blah blah blah blah blah blah';
         //caching to be used later with things we wanna cache
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $cacheKey = md5($testText);
        if ($cache->contains($cacheKey)) {
            $cacheText = $cache->fetch($cacheKey);
        } else {
            sleep(1);
            $cache->save($cacheKey, $testText);
            $cacheText = $testText;
        }


        return $this->render('poster/show.html.twig', [
            'id' => $id,
            'cache' => $cacheText,
        ]);
    }

    /**
     * @Route("/poster/{id}/replies", name="poster_show_replies")
     * @Method("GET")
     */
    public function getRepliesAction()
    {
        $replies = [
            ['id' => 19, 'username' => 'hBoyer', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
        ];

        $data = [
            'replies' => $replies,
        ];

        return new JsonResponse($data);
    }
}