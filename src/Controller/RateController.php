<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    #[Route('/rate', name: 'app_rate')]
    public function index(): Response
    {
        return $this->render('rate/index.html.twig', [
            'controller_name' => 'RateController',
        ]);
    }
    #[Route('/rate/{id}', name: 'app_rate_id', requirements: [ "id" => '\d+' ])] // requirements signifie que 'id' doit être un décimal 
    public function rate( int $id ): Response 
    {
        return new Response('Votre note : ' . $id, 200);
    }
}
