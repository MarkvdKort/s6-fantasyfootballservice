<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FantasyTeam;

class FantasyTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $fantasyTeam = FantasyTeam::firstOrCreate([
            'name' => 'The Best Team',
            'league_id' => 1,
            'user_id' => 1,
        ]);
    }
}
