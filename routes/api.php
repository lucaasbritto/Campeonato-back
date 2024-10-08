<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FootballController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('teams', [FootballController::class, 'searchTeams']);
Route::get('classification', [FootballController::class, 'searchClassification']);
Route::get('matches', [FootballController::class, 'searchMatches']);
Route::get('topScorers', [FootballController::class, 'searchTopScorer']);
