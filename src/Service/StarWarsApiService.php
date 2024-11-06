<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class StarWarsApiService

{
    private const BASE_URL = 'https://swapi.py4e.com/api/people/';
    private const ITEM = 'ITEM';
    private const COLLECTION = 'COLLECTION';

    public function __construct(
        private readonly HttpClientInterface $httpClientInterface
    )
    {       
    }

    /* Création de la méthode personnages */
    public function getPersonnages(): array
    {
        return $this->makeRequest(self::COLLECTION);
    }

    /* Création de la méthode personnage */
    public function getPersonnage(int $id): array
    {
        return $this->makeRequest(self::ITEM, $id);
    }



    /* Création d'une class private pour récupérer les données. */
    private function makeRequest(string $type, ?int $id = null): array
    {
        $url = $id ? self::BASE_URL . $id : self::BASE_URL;
        $response = $this->httpClientInterface->request('GET', $url);
        $data = match ($type) {
            self::COLLECTION => $response->toArray()['results'],
            self::ITEM => $response->toArray(),
        };
        return $data;
    }
}