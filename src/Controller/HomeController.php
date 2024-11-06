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

    /*Création d'une route pour afficher un personnage.*/
    /* On peut utiliser le paramètre requirements pour spécifier que l'id doit être un nombre.*/
    
    #[Route('/personnage/{id}', name: 'app_personnage', requirements: ['id' => '\d+'])]
    public function personnage(int $id, HttpClientInterface $httpClientInterface): Response
    {
        $personnage = $httpClientInterface->request('GET', 'https://swapi.py4e.com/api/people/'.$id);
        
        return $this->render('home/personnage.html.twig', [
            'personnage' => $personnage->toArray(),
        ]);
    }
}
