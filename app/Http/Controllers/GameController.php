<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGamePost;
use App\Mail\GameDetail;
use App\Model\Game;
use App\Repository\GameRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GameController extends Controller
{
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this-> gameRepository= $gameRepository;
    }

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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(StoreGamePost $request)
    {
        $game=$this->gameRepository->handleCreate($request);
        return response()->json($game);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Game $game)
    {
        return response()->json($game);
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
