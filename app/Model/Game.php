<?php

namespace App\Model;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use CrudTrait;
    protected $table='games';
    protected $fillable=['number_of_players','rate_per_point','winner_points_per_seen','winner_points_per_unseen','dubli_winner_points_per_seen','dubli_winner_points_per_unseen','view_token_id','edit_token_id'];


    public function players()
    {
        return $this -> hasMany(Player::class);
    }

    public function rounds()
    {
        return $this -> hasMany(Round::class);
    }
}
