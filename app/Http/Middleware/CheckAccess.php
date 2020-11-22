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
        if(!($request->input('code'))){
            return response()->json(['error'=>'Please enter your code']);
        }
       $game=Game::where('view_token_id',$request->input('code'))->orWhere('edit_token_id',$request->input('code'))->first();
        if(!($game instanceof Game)){
            return response()->json(['error'=>'Invalid Code']);
        }
        return $next($request);

    }
}
