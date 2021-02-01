<?php

namespace App\Model;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use CrudTrait;
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
