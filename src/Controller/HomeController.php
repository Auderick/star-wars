<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ){       
    }
    
    /* Création d'une route pour afficher la liste des personnages.*/
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {       
        return $this->render('home/index.html.twig', [
            'personnages' => $this->starWarsApiService->getPersonnages(),
        ]);
    }

    /* Création d'une route pour afficher un personnage.*/
    /* On peut utiliser le paramètre requirements pour spécifier que l'id doit être un nombre.*/

    #[Route('/personnage/{id}', name: 'app_personnage', requirements: ['id' => '\d+'])]
    public function personnage(int $id): Response
    {        
        return $this->render('home/personnage.html.twig', [
            'personnage' => $this->starWarsApiService->getPersonnage($id),
        ]);
    }
}
