<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/9/16
 * Time: 12:12 PM
 */

namespace PosterBundle\Controller;


use AppBundle\Controller\BaseController;
use AppBundle\Entity\Genus;
use PosterBundle\Entity\Poster;
use PosterBundle\Entity\PosterReply;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PosterController extends BaseController
{
    /**
     * @Route("/poster/auto-new")
     */
    public function newAction()
    {
        $poster = new Poster();
        $poster->setTitle('Need Base Player'.rand(1,1000));
        $poster->setCategory('Sports');
        $poster->setPositionsCount(3);
        $poster->setContent('
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
            Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis 
            parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, 
            pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, 
            aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. 
            Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. 
            Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, 
            consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. 
            Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. 
            Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. 
            Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, 
            sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, 
            lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. 
            Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. 
            Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. 
            Sed consequat, leo eget bibendum sodales, augue velit cursus nunc
        ');
        $poster->setIsPublished(true);

        //create poster reply
//        $posterReply = new PosterReply();
//        $posterReply->setUsername('usman');
//        $posterReply->setAvatarFile('usman.jpg');
//        $posterReply->setReply('this is pretty cool, I am in!!!');
//        $posterReply->setCreatedAt(new \DateTime('-1 month'));
//        $posterReply->setPoster($poster);
//
//        $posterReply1 = new PosterReply();
//        $posterReply1->setUsername('Ryan');
//        $posterReply1->setAvatarFile('ryan.jpeg');
//        $posterReply1->setReply('Wow, I have been waiting for this. Shout out');
//        $posterReply1->setCreatedAt(new \DateTime('-2 month'));
//        $posterReply1->setPoster($poster);
//
//        $posterReply2 = new PosterReply();
//        $posterReply2->setUsername('Becky');
//        $posterReply2->setAvatarFile('leanna.jpeg');
//        $posterReply2->setReply('how far is it from my home?');
//        $posterReply2->setCreatedAt(new \DateTime('-1 month'));
//        $posterReply2->setPoster($poster);
//
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($poster);
//        $em->persist($posterReply);
//        $em->persist($posterReply1);
//        $em->persist($posterReply2);
//        $em->flush();

        return new Response('<html><body>POSTER CREATED</body></html>');
    }

    /**
     * @Route("/posters", name="posters_list")
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
     * @Route("/poster/{id}", name="poster_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $poster = $em->getRepository('PosterBundle:Poster')
            ->findOneBy(['id' => $id]);

        if(!$poster) {
            throw $this->createNotFoundException('This Poster Does Not Exist');
        }

        /*
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
        */

        $recentReplies = $poster->getReplies()
            ->filter(function(PosterReply $reply){
                return $reply->getCreatedAt() > new \DateTime('-2 months');
            });




        return $this->render('poster/show.html.twig', [
            'poster' => $poster,
            'recentReplyCount' => count($recentReplies),
            'picNum' => rand(1,4),
        ]);
    }

    /**
     * @Route("/poster/{id}/replies", name="poster_show_replies")
     * @Method("GET")
     */
    public function getRepliesAction(Poster $poster)
    {
        $replies = [];
        foreach ($poster->getReplies() as $reply) {
            $replies[] = [
                'id' => $reply->getId(),
                'username' => $reply->getUsername(),
                'avatarUri' => '/images/'.$reply->getAvatarFile(),
                'note' => $reply->getReply(),
                'date' => $reply->getCreatedAt()->format('M d, Y'),
            ];
        }

        $data = [
            'replies' => $replies,
        ];

        return new JsonResponse($data);
    }
}