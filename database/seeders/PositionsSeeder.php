<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $defensiveLineman = Position::firstOrCreate([
            'name' => 'Defensive Lineman',
            'abbreviation' => 'DL',
        ]);
        $linebacker = Position::firstOrCreate([
            'name' => 'Linebacker',
            'abbreviation' => 'LB',
        ]);
        $defensiveBack = Position::firstOrCreate([
            'name' => 'Defensive Back',
            'abbreviation' => 'DB',
        ]);
        $runningBack = Position::firstOrCreate([
            'name' => 'Running Back',
            'abbreviation' => 'RB',
        ]);
        $wideReceiver = Position::firstOrCreate([
            'name' => 'Wide Receiver',
            'abbreviation' => 'WR',
        ]);
        $tightEnd = Position::firstOrCreate([
            'name' => 'Tight End',
            'abbreviation' => 'TE',
        ]);
        $quarterback = Position::firstOrCreate([
            'name' => 'Quarterback',
            'abbreviation' => 'QB',
        ]);
    }
}
