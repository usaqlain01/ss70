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

            $em = $this->getDoctrine()->getManager();
            $em->persist($poster);
            $em->flush();

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

            $em = $this->getDoctrine()->getManager();
            $em->persist($poster);
            $em->flush();

            $this->addFlash('success', 'Poster updated!');

            return $this->redirectToRoute('posters_list');
        }

        return $this->render('poster/edit.html.twig', [
            'posterForm' => $form->createView()
        ]);
    }
}