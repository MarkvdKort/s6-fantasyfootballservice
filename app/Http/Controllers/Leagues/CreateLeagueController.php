<?php

namespace App\Http\Controllers\Leagues;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateLeagueRequest;
use App\Http\Requests\CreateUserRequest;
use App\Models\League;
use App\Models\User;
use App\Services\LeagueService;

class CreateLeagueController extends Controller
{
    public function __invoke(CreateLeagueRequest $request, LeagueService $leagueService)
    {
        $data = $request->validated();

        $league = League::create([
            'name' => $data['name'],
            'teams' => $data['teams'],
        ]);

        $leagueService->createTeamsForLeague([
            'league_id' => $league->id,
            'teams' => $data['teams'],
        ]);

        $league->fantasyTeams()->first()->user()->attach($request->user()->id);

        return response()->json('League created', 201);
    }
}
