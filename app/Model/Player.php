<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table='players';
    protected $fillable=['name','email','game_id'];

    public function game(){
        return $this->belongsTo(Game::class,'game_id');
    }
}
