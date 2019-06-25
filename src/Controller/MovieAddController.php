<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Review;
use App\Entity\Cast;
use App\Form\MovieType;
use App\Form\MovieReviewType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/movie_ajax")
 */
class MovieAddController extends AbstractController
{
    /**
     * @Route("/search", name="movie_ajax_find", methods={"GET"})
     */
    public function show(Request $request): Response
    {
        $keyword = $request->query->get("keyword");
        if($keyword!="")
        {
            //dd($keyword[0]);
            $response = file_get_contents("https://v2.sg.media-imdb.com/suggestion/" . $keyword[0] . "/" . $keyword . ".json");
            return new Response($response);
        }
        //dd($request->query->get("keyword"));
        return new Response();
    }
    /**
     * @Route("/add", name="movie_ajax_add", methods={"POST"})
     */
    public function add(Request $request): Response
    {
        $movie = new Movie();
        $movie->setTitle($request->request->get('title'));
        $movie->setReleaseDate(new \DateTime($request->request->get('releasedate')));
        $em = $this->getDoctrine()->getManager();
        $em -> persist($movie);
        $em ->flush();
        $castValue = $request->request->get('cast');
        if(strpos($castValue, ',') !== false)
        {
            $casts = explode(",",$castValue);
            foreach ($casts as $castData)
            {
                $cast = new Cast();
                $cast ->setFullName($castData);
                $cast ->addMovie($movie);
                $em -> persist($cast);
                $em ->flush();
            }
        }
        else
        {
            $cast = new Cast();
            $cast ->setFullName($castValue);
            $cast ->addMovie($movie);
            $em ->persist($cast);
            $em ->flush();


        }
        //DONE: Add data to DB once route starts working.
        // TODO: Implement Movie cast persist from request.
        return new Response();
    }
}
