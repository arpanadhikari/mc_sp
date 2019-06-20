<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\MovieType;
use App\Form\MovieReviewType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movie_ajax")
 */
class MovieAddController extends AbstractController
{
    /**
     * @Route("/new", name="movie_ajax_add", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('movie_ajax_add');
        }

        return $this->render('movie/new.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{keyword}", name="movie_ajax_find", methods={"GET"})
     */
    public function show(Movie $movie): Response
    {
        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }
}
