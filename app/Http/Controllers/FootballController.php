<?php

namespace App\Http\Controllers;

use App\Services\FootballService;
use Illuminate\Http\Request;


/**
 * @OA\Info(title="Football API", version="1.0", description="API to retrieve football-related data.")
 * @OA\Server(url=env('APP_ENV') === 'local' ? config('app.url') . '/api' : env('API_URL'))
 */

class FootballController extends Controller{
    protected $footballService;

    public function __construct(FootballService $footballService)
    {
        $this->footballService = $footballService;
    }

    /**
     * @OA\Get(
     *     path="/teams",
     *     tags={"Football"},
     *     summary="Buscar Times",
     *     description="Exibe todos os dados de cada time",
     *     @OA\Response(
     *         response=200,
     *         description="Exibindo todos os dados de cada clube",
     *         @OA\JsonContent(type="array", @OA\Items(
     *             @OA\Property(property="id", type="integer", description="ID of the team", example=1765),
     *             @OA\Property(property="name", type="string", description="Nome do Time", example="Fluminense FC"),
     *             @OA\Property(property="crest", type="string", description="Escudo do time", example="https://crests.football-data.org/1765.png")
     *         ))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Time não encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No teams found")
     *         )
     *     )
     * )
     */

    public function searchTeams(){
        $data = $this->footballService->getTeams();
        return response()->json($data);
    }




    /**
 * @OA\Get(
 *     path="/classification",
 *     tags={"Football"},
 *     summary="Tabela de classificação",
 *     description="Exibe a tabela de classifição do campeonato",
 *     @OA\Response(
 *         response=200,
 *         description="Exibe a tabela de classifição do campeonato",
 *         @OA\JsonContent(type="array", @OA\Items(
 *             @OA\Property(property="position", type="integer", description="Position in the league", example=1),
 *             @OA\Property(property="team", type="object",
 *                 @OA\Property(property="id", type="integer", description="Team ID", example=1770),
 *                 @OA\Property(property="name", type="string", description="Team name", example="Botafogo FR"),
 *                 @OA\Property(property="shortName", type="string", description="Short name of the team", example="Botafogo"),
 *                 @OA\Property(property="tla", type="string", description="Three-letter abbreviation", example="BOT"),
 *                 @OA\Property(property="crest", type="string", description="Team crest URL", example="https://crests.football-data.org/1770.png")
 *             ),
 *             @OA\Property(property="playedGames", type="integer", description="Total games played", example=27),
 *             @OA\Property(property="form", type="string", description="Recent form", example=null),
 *             @OA\Property(property="won", type="integer", description="Games won", example=17),
 *             @OA\Property(property="draw", type="integer", description="Games drawn", example=5),
 *             @OA\Property(property="lost", type="integer", description="Games lost", example=5),
 *             @OA\Property(property="points", type="integer", description="Total points", example=56),
 *             @OA\Property(property="goalsFor", type="integer", description="Goals scored", example=46),
 *             @OA\Property(property="goalsAgainst", type="integer", description="Goals conceded", example=25),
 *             @OA\Property(property="goalDifference", type="integer", description="Goal difference", example=21)
 *         ))
 *     )
 * )
 */
    public function searchClassification(){
        $data = $this->footballService->getClassification();
        return response()->json($data);        
    }



    /**
 * @OA\Get(
 *     path="/matches",
 *     tags={"Football"},
 *     summary="Todos os jogos por rodada",
 *     description="Exibe todos os jogos do campeonato",
 *     @OA\Response(
 *         response=200,
 *         description="Exibe todos os jogos do campeonato",
 *         @OA\JsonContent(type="array", @OA\Items(
 *             @OA\Property(property="id", type="integer", description="Match ID", example=494031),
 *             @OA\Property(property="utcDate", type="string", description="Match date in UTC", example="2024-09-28T21:30:00Z"),
 *             @OA\Property(property="status", type="string", description="Current status of the match", example="TIMED"),
 *             @OA\Property(property="matchday", type="integer", description="Matchday number", example=28),
 *             @OA\Property(property="stage", type="string", description="Stage of the match", example="REGULAR_SEASON"),
 *             @OA\Property(property="group", type="string", description="Match group", example=null),
 *             @OA\Property(property="lastUpdated", type="string", description="Last update time", example="2024-09-24T00:20:51Z"),
 *             @OA\Property(property="homeTeam", type="object",
 *                 @OA\Property(property="id", type="integer", description="Home team ID", example=1769),
 *                 @OA\Property(property="name", type="string", description="Home team name", example="SE Palmeiras"),
 *                 @OA\Property(property="shortName", type="string", description="Home team short name", example="Palmeiras"),
 *                 @OA\Property(property="tla", type="string", description="Home team TLA", example="PAL"),
 *                 @OA\Property(property="crest", type="string", description="Home team crest URL", example="https://crests.football-data.org/1769.png")
 *             ),
 *             @OA\Property(property="awayTeam", type="object",
 *                 @OA\Property(property="id", type="integer", description="Away team ID", example=1766),
 *                 @OA\Property(property="name", type="string", description="Away team name", example="CA Mineiro"),
 *                 @OA\Property(property="shortName", type="string", description="Away team short name", example="Mineiro"),
 *                 @OA\Property(property="tla", type="string", description="Away team TLA", example="CAM"),
 *                 @OA\Property(property="crest", type="string", description="Away team crest URL", example="https://crests.football-data.org/1766.png")
 *             ),
 *             @OA\Property(property="score", type="object",
 *                 @OA\Property(property="winner", type="string", description="Winning team", example=null),
 *                 @OA\Property(property="duration", type="string", description="Match duration", example="REGULAR"),
 *                 @OA\Property(property="fullTime", type="object",
 *                     @OA\Property(property="home", type="integer", description="Full-time score for home team", example=null),
 *                     @OA\Property(property="away", type="integer", description="Full-time score for away team", example=null)
 *                 ),
 *                 @OA\Property(property="halfTime", type="object",
 *                     @OA\Property(property="home", type="integer", description="Half-time score for home team", example=null),
 *                     @OA\Property(property="away", type="integer", description="Half-time score for away team", example=null)
 *                 )
 *             )
 *         ))
 *     )
 * )
 */
    public function searchMatches(Request $request){
        $data = $this->footballService->getMatches();
        return response()->json($data);    
    }




    /**
 * @OA\Get(
 *     path="/topScorers",
 *     tags={"Football"},
 *     summary="Buscar artilharia e assistencia",
 *     description="Exibe os jogadores com mais gols e assistencia na competição",
 *     @OA\Response(
 *         response=200,
 *         description="Exibe os jogadores com mais gols e assistencia na competição",
 *         @OA\JsonContent(type="array", @OA\Items(
 *             @OA\Property(property="player", type="object",
 *                 @OA\Property(property="id", type="integer", description="Player ID", example=1077),
 *                 @OA\Property(property="name", type="string", description="Player name", example="Pedro")
 *             ),
 *             @OA\Property(property="team", type="object",
 *                 @OA\Property(property="id", type="integer", description="Team ID", example=1783),
 *                 @OA\Property(property="name", type="string", description="Team name", example="CR Flamengo"),
 *                 @OA\Property(property="shortName", type="string", description="Short name of the team", example="Flamengo"),
 *                 @OA\Property(property="tla", type="string", description="Three-letter abbreviation", example="FLA"),
 *                 @OA\Property(property="crest", type="string", description="Team crest URL", example="https://crests.football-data.org/1783.png")
 *             ),
 *             @OA\Property(property="playedMatches", type="integer", description="Matches played by the player", example=21),
 *             @OA\Property(property="goals", type="integer", description="Total goals scored", example=11),
 *             @OA\Property(property="assists", type="integer", description="Total assists made", example=5),
 *             @OA\Property(property="penalties", type="integer", description="Total penalties scored", example=4)
 *         ))
 *     )
 * )
 */

    public function searchTopScorer(Request $request){
        $data = $this->footballService->getTopScorer();
        return response()->json($data);    
    }
}
