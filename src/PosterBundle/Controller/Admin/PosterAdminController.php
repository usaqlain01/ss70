<?php
/**
 * Created by PhpStorm.
 * User: usman
 * Date: 7/17/16
 * Time: 6:25 PM
 */

namespace PosterBundle\Controller\Admin;

use AppBundle\Controller\BaseController;
use PosterBundle\Entity\Poster;
use PosterBundle\Entity\PosterReply;
use PosterBundle\Form\PosterFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PosterAdminController extends BaseController
{
    
    /**
     * @Route("/poster/create", name="user_poster_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(PosterFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poster = $form->getData();

            $this->addCommentsAction($poster);

//            $em = $this->getDoctrine()->getManager();
//            $em->persist($poster);
//            $em->flush();

            $this->addFlash(
                'success',
                sprintf('Poster created by you: %s!', $this->getUser()->getEmail())
            );

            return $this->redirectToRoute('posters_list');
        }

        return $this->render('poster/new.html.twig', [
            'posterForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/poster/{id}/edit", name="user_poster_edit")
     */
    public function editAction(Request $request, Poster $poster)
    {
        $form = $this->createForm(PosterFormType::class, $poster);

        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $poster = $form->getData();

            $this->addCommentsAction($poster);

//            $em = $this->getDoctrine()->getManager();
//            $em->persist($poster);
//            $em->flush();

            $this->addFlash('success', 'Poster updated!');

            return $this->redirectToRoute('posters_list');
        }

        return $this->render('poster/edit.html.twig', [
            'posterForm' => $form->createView()
        ]);
    }

    protected function addCommentsAction($poster){

        //$posterReply = new PosterReply();

        $posterReply = new PosterReply();

        $posterReply->setUsername('usman');
        $posterReply->setAvatarFile('usman.jpg');
        $posterReply->setReply('this is pretty cool, I am in!!!');
        $posterReply->setCreatedAt(new \DateTime('-1 month'));
        $posterReply->setPoster($poster);

        $posterReply1 = new PosterReply();
        $posterReply1->setUsername('Ryan');
        $posterReply1->setAvatarFile('ryan.jpeg');
        $posterReply1->setReply('Wow, I have been waiting for this. Shout out');
        $posterReply1->setCreatedAt(new \DateTime('-2 month'));
        $posterReply1->setPoster($poster);

        $posterReply2 = new PosterReply();
        $posterReply2->setUsername('Becky');
        $posterReply2->setAvatarFile('leanna.jpeg');
        $posterReply2->setReply('how far is it from my home?');
        $posterReply2->setCreatedAt(new \DateTime('-1 month'));
        $posterReply2->setPoster($poster);


        $em = $this->getDoctrine()->getManager();
        $em->persist($poster);
        $em->persist($posterReply);
        $em->persist($posterReply1);
        $em->persist($posterReply2);
        $em->flush();

    }
}