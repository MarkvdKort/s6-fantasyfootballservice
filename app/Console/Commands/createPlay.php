<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Play;

class createPlay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $play = Play::create([
            'title' => 'Play title',
            'description' => 'Play description',
        ]);
        $this->info('Play created successfully');
        $this->info('Play ID: ' . $play->_id);
    }
}
