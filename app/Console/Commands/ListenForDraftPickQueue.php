<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Models\FantasyTeam;
use App\Models\Player;

class ListenForDraftPickQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:listen-for-draft-pick-queue';

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
        $connection = new AMQPStreamConnection(
            config('services.rabbitmq.host'),
            config('services.rabbitmq.port'),
            config('services.rabbitmq.user'),
            config('services.rabbitmq.password'),
            config('services.rabbitmq.vhost')
        );

        $channel = $connection->channel();
        $channel->queue_declare('draftpick_created', false, true, false, false);

        $channel->basic_consume('draftpick_created', '', false, true, false, false, function ($message) {
            $data = json_decode($message->body, true);
            $this->info(" [x] Received {$data['fantasy_team_id']} {$data['player_id']}");
            $fantasyTeam = FantasyTeam::findOrFail($data['fantasy_team_id']);
            $player = Player::findOrFail($data['player_id']);

            $fantasyTeam->players()->attach($player, [
                'drafted_at' => $data['round'] . '.' . $data['pick'],
            ]);

            // $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
            $this->info("{$player->last_name} added to fantasy team");
        });

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
    }
}
