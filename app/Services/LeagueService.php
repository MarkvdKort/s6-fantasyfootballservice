<?php

namespace App\Services;

use App\Models\League;

class LeagueService
{
    public function createTeamsForLeague($data)
    {
        $league = League::findOrFail($data['league_id']);

        for ($i = 0; $i < $data['teams']; $i++) {
            $league->fantasyTeams()->create([
                'name' => 'Team ' . $i,
                'user_id' => null,
            ]);
        }

        return $league;
    }
}