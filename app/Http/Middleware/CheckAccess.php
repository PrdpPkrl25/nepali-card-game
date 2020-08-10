<?php

namespace App\Http\Middleware;

use App\Model\Game;
use Closure;

class CheckAccess
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
        session()->forget('game');
        if(!($request->input('code_id'))){
            return redirect()->route('code.input.page');
        }
       $game=Game::where('view_token_id',$request->input('code_id'))->orWhere('edit_token_id',$request->input('code_id'))->first();
        if(!($game instanceof Game)){
            abort(404);
        }
        if($request->input('code_id')==$game->edit_token_id){
            session()->put('game',$game);
        }
        return $next($request);

    }
}
