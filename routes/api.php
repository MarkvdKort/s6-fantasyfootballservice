<?php

use App\Http\Controllers\FantasyTeams\CreateFantasyTeamController;
use App\Http\Controllers\Leagues\CreateLeagueController;
use App\Http\Controllers\Users\CreateUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('leagues/create', CreateLeagueController::class);
Route::post('fantasy-teams/create', CreateFantasyTeamController::class);
Route::post('users/create', CreateUserController::class);

Route::get('leagues', function () {
    return response()->json('Leagues', 200);
});