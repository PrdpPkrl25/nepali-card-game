<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerPost;
use App\Mail\GameDetail;
use App\Model\Game;
use App\Model\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $game=session()->get('game');
        return view('players.add_players',compact('game'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $gameId=$request->id;
        $player_array=['name'=>$request->playerName,'email'=>$request->email,'game_id'=>$gameId];
        $player=Player::create($player_array);
        $game=Game::with('players')->findOrFail($gameId);
        $number=$game->players->count();
        $players=Player::where('game_id',$gameId)->get();
         return response()->json(['players'=>$players,'player_number'=>$number]);
    }

    /**
     * Display the specified resource.
     *
     * @param $gameId
     * @return void
     */
    public function show($gameId)
    {
        $players=Player::where('game_id',$gameId)->get();
        return response()->json($players);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }
}
