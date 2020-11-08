<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table='rounds';
    protected $fillable=['game_id'];

    public function points()
    {
        return $this -> hasMany(Point::class)->orderBy('player_id');
    }

    public function game()
    {
        return $this -> belongsTo(Game::class);
    }
}
