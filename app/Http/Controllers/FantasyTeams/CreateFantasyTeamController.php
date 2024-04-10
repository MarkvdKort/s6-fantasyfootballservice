<?php

namespace App\Http\Controllers\FantasyTeams;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\FantasyTeam;
use App\Models\League;
use App\Models\User;

class CreateFantasyTeamController extends Controller
{
    public function __invoke(CreateUserRequest $request)
    {
        $data = $request->validated();
        
        $user = User::findOrFail($data['user_id']);

        $league = League::findOrFail($data['league_id']);

        $fantasyTeam = FantasyTeam::create([
            'name' => $data['name'],
            'user_id' => $user->id,
            'league_id' => $league->id,
        ]);

        $user->fantasyTeams()->attach($fantasyTeam);

        return response()->json([
            'team' => $user->user_name,
        ], 201);
    }
}
