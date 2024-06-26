<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(PositionsSeeder::class);
        $this->call(TeamsSeeder::class);
        $this->call(PlayersSeeder::class);
        $this->call(LeaguesSeeder::class);
        $this->call(FantasyTeamSeeder::class);
    }
}
