<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
        ]);
    }

    #[Route('/movie', name: 'app_movies')]
    public function list(): Response 
    {
        return $this->render('movie/list.html.twig', [
            'mavariable' => 'Lesgo ça marche'
        ]);
    }

    #[Route('/movie/random', name: 'app_movie_random')] 
    public function randomMovie(): Response 
    {
        return new Response('Film au hasard', 200);
    }

    #[Route('/movie/{name}', name: 'app_movie_search')]
    public function movieSearchByName( string $name): Response
    {
        $name = $_POST['movie'];
        $movieList = $this->search($name);
        return $this->render('movie/movie.html.twig', [
            'name' => $name, 
            'movieList' => $movieList
        ]);
    }
    
    public function search (string $term):array {
        $themovieAPIKey = $_ENV['TMNDB_API_KEY'];

        // Création du endpoint de l'API (film recherché + clé API)
        $endpoint = 'https://api.themoviedb.org/3/search/movie?api_key=' . 
            $themovieAPIKey . "&query=" . $term . "&language=fr-FR&page=1";

        // Lancement d'une requête HTTP
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);

        $resultat_curl = curl_exec($ch);

        // On transforme le résultat de cURL en un objet JSON utilisable
        $json = json_decode ( $resultat_curl );

        // Renvoi du JSON
        /**
         * @TODO: tester la valeur de $json avant le renvoi
         */
        return $json->results;
    }


}
