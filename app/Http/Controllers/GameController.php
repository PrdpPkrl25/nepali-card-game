<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGamePost;
use App\Mail\GameDetail;
use App\Model\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GameController extends Controller
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
        session()->forget('game');
     return view('games.create_game');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(StoreGamePost $request)
    {
        $viewTokenId=rand(1000,100000);
        $editTokenId=rand(1000,100000);
        $game=Game::create($request->all()+['view_token_id'=>$viewTokenId,'edit_token_id'=>$editTokenId]);
        session()->put('game',$game);
        return redirect()->route('players.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }

    public function info()
    {
        $game=session()->get('game');
        return view('games.game_info',compact('game'));

    }
}
