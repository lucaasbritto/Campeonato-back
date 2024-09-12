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
}
