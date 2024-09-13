<?php

namespace App\Http\Controllers;

use App\Services\FootballService;
use Illuminate\Http\Request;

class FootballController extends Controller{
    protected $footballService;

    public function __construct(FootballService $footballService)
    {
        $this->footballService = $footballService;
    }

    public function searchTeams(){
        $data = $this->footballService->getTeams();
        return response()->json($data);
    }

    public function searchClassification(){
        $data = $this->footballService->getClassification();
        return response()->json($data);        
    }
}
