<?php

namespace App\Model;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use CrudTrait;
    protected $table='players';
    protected $fillable=['name','email','game_id'];

    public function game(){
        return $this->belongsTo(Game::class,'game_id');
    }

    public function points(){
        return $this->hasMany(Point::class,'player_id');
    }


}
