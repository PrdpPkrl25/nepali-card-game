<?php

namespace App\Http\Middleware;

use App\Model\Game;
use App\Model\Player;
use Closure;

class PlayerCountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $gameId=$request->id;
        $playersCount=Player::where('game_id',$gameId)->count();
        $numberOfPlayers=Game::where('id',$gameId)->first();
        if($playersCount!==$numberOfPlayers){
            return response()->json();
        }
        return $next($request);
    }
}
