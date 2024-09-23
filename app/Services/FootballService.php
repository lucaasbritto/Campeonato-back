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

    // Buscar Classificação
    public function getClassification(){
        try {
            $response = $this->client->get("competitions/BSA/standings");
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Erro ao buscar a classficação do campeonato: ' . $e->getMessage()];
        }        
    }

    // Buscar Partidas
    public function getMatches(){
        try {
            //Buscar numero da ultima rodada
            $classification = $this->getClassification();
            $lastMatchday = $classification['season']['currentMatchday'];

            $response = $this->client->get("competitions/2013/matches");
            $matches = json_decode($response->getBody()->getContents(), true)['matches'];

            // Organize as partidas por número de rodada
            $groupedByMatchday = collect($matches)->groupBy('matchday');

            // Identifica o maior número de rodada (última rodada)
            $lastMatchdayMatches = $groupedByMatchday->get($lastMatchday, []);

            // Verifica se todos os jogos da rodada foi finalizado
            $allFinished = collect($lastMatchdayMatches)->every(function ($match) {
                return $match['status'] === 'FINISHED';                
            });
                
            // Se todos os jogos estão completos, pega a próxima rodada
            if ($allFinished) {
                $nextMatchday = $lastMatchday + 1;
                $nextMatchdayMatches = $groupedByMatchday->get($nextMatchday, []);
                return response()->json([
                    'lastMatchday' => $lastMatchday,
                    'nextMatchday' => $nextMatchday,
                    'matchDay' => $nextMatchdayMatches,
                    'allMatches' => $matches
                ]);
            }
           
            // Retorna as partidas da última rodada            
            return response()->json([
                'lastMatchday' => $lastMatchday,
                'matchDay' => $lastMatchdayMatches,
                'allMatches' => $matches
            ]);
        } catch (RequestException $e) {
            return ['error' => 'Erro ao buscar a classficação do campeonato: ' . $e->getMessage()];
        }
    }

    // Buscar Artilheiro
    public function getTopScorer(){
        try {
            $response = $this->client->get("competitions/BSA/scorers?limit=20");
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => 'Erro ao buscar Artilheiro do campeonato: ' . $e->getMessage()];
        } 
    }  


    
}