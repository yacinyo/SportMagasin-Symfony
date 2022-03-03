<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
 
class CallApiService{

    private $client;

    public function __construct(HttpClientInterface $client){
        $this->client = $client;
    }

    public function getDepartement():array
    {
        $apiUrl = 'https://geo.api.gouv.fr/departements?fields=nom,code,codeRegion';

        $reponse = $this->client->request(
            'GET',
            $apiUrl
        );

        return $reponse->toArray();
    }

   
}




?>