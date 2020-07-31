<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table='points';
    protected $fillable=['player_id','round_id','point_scored'];
}
