<?php

namespace App\Controller;

use App\Entity\Sujet;
use App\Form\SujetType;
use App\Repository\SujetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer;

/**
 * @Route("/sujet")
 */
class SujetController extends AbstractController
{
    /**
     * @Route("/", name="sujet_index", methods={"GET"})
     */
    public function index(SujetRepository $sujetRepository): Response
    {
        return $this->render('sujet/index.html.twig', [
            'sujets' => $sujetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sujet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sujet = new Sujet();
        $form = $this->createForm(SujetType::class, $sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sujet);
            $entityManager->flush();

            return $this->redirectToRoute('sujet_index');
        }

        return $this->render('sujet/new.html.twig', [
            'sujet' => $sujet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sujet_show", methods={"GET"})
     */
    public function show(Sujet $sujet): Response
    {
        return $this->render('sujet/show.html.twig', [
            'sujet' => $sujet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sujet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sujet $sujet): Response
    {
        $form = $this->createForm(SujetType::class, $sujet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sujet_index');
        }

        return $this->render('sujet/edit.html.twig', [
            'sujet' => $sujet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sujet_delete", methods={"POST"})
     */
    public function delete(Request $request, Sujet $sujet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sujet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sujet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sujet_index');
    }
    /**
     * @Route("/searchSujet", name="searchSujet")
     */

}
