<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HttpClientInterface $httpClientInterface): Response
    {
        /* Pour envoyer une requête HTTP, il faut utiliser l'interface HttpClientInterface.*/
        $personnage = $httpClientInterface->request('GET', 'https://swapi.py4e.com/api/people/');
        
        return $this->render('home/index.html.twig', [
            'personnages' => $personnage->toArray()['results'],
        ]);
    }
}
