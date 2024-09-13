<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FootballService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://api.football-data.org/v4/',
            'headers' => [
                'accept' => 'application/json',
                'X-Auth-Token' => env('FOOTBALL_API_KEY', 'default_token'),
            ],
        ]);
    }

    // Buscar Times
    public function getTeams(){
        try {
            $response = $this->client->get("competitions/BSA/teams");
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Erro ao buscar os times: ' . $e->getMessage()];
        }        
    }

    
}