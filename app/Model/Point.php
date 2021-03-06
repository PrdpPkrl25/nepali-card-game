<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table='points';
    protected $fillable=['player_id','round_id','point_scored','seen','dubli','winner'];

    public function round(){
        return $this->belongsTo(Round::class,'round_id');
    }

    public function player(){
        return $this->belongsTo(Player::class,'player_id');
    }
}
