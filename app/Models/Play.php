<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Play extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'plays';

    protected $guarded = ['_id', 'created_at'];

    // protected $casts = ['timestamp_from' => 'datetime', 'timestamp_to' => 'datetime'];
}
