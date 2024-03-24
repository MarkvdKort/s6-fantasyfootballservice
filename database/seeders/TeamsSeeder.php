<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $teams = [
            'Arizona Cardinals',
            'Atlanta Falcons',
            'Baltimore Ravens',
            'Buffalo Bills',
            'Carolina Panthers',
            'Chicago Bears',
            'Cincinnati Bengals',
            'Cleveland Browns',
            'Dallas Cowboys',
            'Denver Broncos',
            'Detroit Lions',
            'Green Bay Packers',
            'Houston Texans',
            'Indianapolis Colts',
            'Jacksonville Jaguars',
            'Kansas City Chiefs',
            'Las Vegas Raiders',
            'Los Angeles Chargers',
            'Los Angeles Rams',
            'Miami Dolphins',
            'Minnesota Vikings',
            'New England Patriots',
            'New Orleans Saints',
            'New York Giants',
            'New York Jets',
            'Philadelphia Eagles',
            'Pittsburgh Steelers',
            'San Francisco 49ers',
            'Seattle Seahawks',
            'Tampa Bay Buccaneers',
            'Tennessee Titans',
            'Washington Commanders',
        ];

        foreach ($teams as $team) {
            Team::firstOrCreate(['name' => $team]);
        }

    }
}
