<?php

namespace App\Controller;

use App\Entity\Cast;
use App\Form\CastType;
use App\Repository\CastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cast")
 */
class CastController extends AbstractController
{
    /**
     * @Route("/", name="cast_index", methods={"GET"})
     */
    public function index(CastRepository $castRepository): Response
    {
        return $this->render('cast/index.html.twig', [
            'casts' => $castRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cast_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cast = new Cast();
        $form = $this->createForm(CastType::class, $cast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cast);
            $entityManager->flush();

            return $this->redirectToRoute('cast_index');
        }

        return $this->render('cast/new.html.twig', [
            'cast' => $cast,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cast_show", methods={"GET"})
     */
    public function show(Cast $cast): Response
    {
        return $this->render('cast/show.html.twig', [
            'cast' => $cast,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cast_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cast $cast): Response
    {
        $form = $this->createForm(CastType::class, $cast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cast_index', [
                'id' => $cast->getId(),
            ]);
        }

        return $this->render('cast/edit.html.twig', [
            'cast' => $cast,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cast_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cast $cast): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cast->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cast);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cast_index');
    }
}
