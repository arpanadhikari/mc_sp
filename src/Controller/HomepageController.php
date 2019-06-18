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
 * @Route("/")
 */
class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
     */
    public function index(CastRepository $castRepository): Response
    {
        return $this->render('index.html.twig', [
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
}
