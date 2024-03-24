<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $player = Player::firstOrCreate([
            'first_name' => 'Patrick',
            'last_name' => 'Mahomes',
            'position_id' => 7,
            'team_id' => 16,
            'height' => 185,
            'weight' => 230,
        ]);
    }
}
