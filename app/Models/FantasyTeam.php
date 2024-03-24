<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FantasyTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'fantasy_teams';

    protected $fillable = [
        'name',
        'user_id',
        'league_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class, 'fantasyteam_has_players');
    }
}
