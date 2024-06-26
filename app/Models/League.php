<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class League extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'teams',
    ];

    public function fantasyTeams()
    {
        return $this->hasMany(FantasyTeam::class);
    }
}
