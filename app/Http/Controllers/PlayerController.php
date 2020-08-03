<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerPost;
use App\Mail\GameDetail;
use App\Model\Player;
use Illuminate\Http\Request;
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
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePlayerPost $request)
    {
       $game=session()->get('game');
       for ($i=0;$i<$game->number_of_players;$i++){
           $name=$request->all()['name'][$i];
           $email=$request->all()['email'][$i];
           $player_array=['name'=>$name,'email'=>$email,'game_id'=>$game->id];
           $player=Player::create($player_array);
           if(!$player->email==Null){
               Mail::to($player->email)->send(new GameDetail($game));
           }
       }

      return redirect()->route('points.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
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
