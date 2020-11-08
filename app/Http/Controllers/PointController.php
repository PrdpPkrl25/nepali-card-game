<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointsPost;
use App\Model\Game;
use App\Model\Player;
use App\Model\Point;
use App\Model\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PointController extends Controller
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
        $game = session() -> get('game');
        $players = Player ::with('game') -> where('game_id', $game -> id) -> get();
        return view('rounds.add_round_result', compact('game', 'players'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePointsPost $request)
    {
        $game = $request->game;
        $round = Round ::create(['game_id' => $game -> id]);
        $winner = $request -> winner;
        $sumAllPoints = array_sum($request -> all()['points']);
        $winnerPoint = 0;
        foreach($request -> all()['points'] as $key => $value) {
            if($key == $winner) {
                continue;
            }

            if(isset($request -> all()['seen'][$key]) && $request -> all()['seen'][$key] == 'on') {
                if(isset($request -> all()['dubli'][$winner]) && $request -> all()['dubli'][$winner] == 'on') {
                    if(isset($request -> all()['dubli'][$key]) && $request -> all()['dubli'][$key] == 'on') {
                        $pointSecured = ($value * $game -> number_of_players) - ($sumAllPoints);
                        $pointArray = ['player_id' => $key, 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1,'dubli'=>1];
                    } else {
                        $pointSecured = ($value * $game -> number_of_players) - ($sumAllPoints + $game -> dubli_winner_points_per_seen);
                        $pointArray = ['player_id' => $key, 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1];
                    }
                } else {
                    if(isset($request -> all()['dubli'][$key]) && $request -> all()['dubli'][$key] == 'on') {
                        $pointSecured = ($value * $game -> number_of_players) - ($sumAllPoints);
                        $pointArray = ['player_id' => $key, 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1,'dubli'=>1];
                    } else {
                        $pointSecured = ($value * $game -> number_of_players) - ($sumAllPoints + $game -> winner_points_per_seen);
                        $pointArray = ['player_id' => $key, 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1];
                    }
                }
            } else {
                if(isset($request -> all()['dubli'][$winner]) && $request -> all()['dubli'][$winner] == 'on') {
                    $pointSecured = -1 * ($sumAllPoints + $game -> dubli_winner_points_per_unseen);
                    $pointArray = ['player_id' => $key, 'round_id' => $round -> id, 'point_scored' => $pointSecured];
                } else {
                    $pointSecured = -1 * ($sumAllPoints + $game -> winner_points_per_unseen);
                    $pointArray = ['player_id' => $key, 'round_id' => $round -> id, 'point_scored' => $pointSecured];
                }

            }

            Point ::create($pointArray);
            $winnerPoint = $winnerPoint + $pointSecured;
        }
        $winnerDubli=(isset($request -> all()['dubli'][$winner]) && $request -> all()['dubli'][$winner] == 'on')?1:0;
        $winnerArray = ['player_id' => $winner, 'round_id' => $round -> id, 'point_scored' => -1*$winnerPoint,'seen'=>1,'dubli'=>$winnerDubli,'winner'=>1];
        Point ::create($winnerArray);
        return redirect() -> route('points.show', $round -> id);
    }



    /**
     * Display the specified resource.
     *
     * @param $roundId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($roundId)
    {

        $points=Point::with('player')->where('round_id',$roundId)->get();
        $round=Round::with('game')->where('id',$roundId)->first();
        return response()->json(['points'=>$points,'round'=>$round]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($roundId)
    {
        Round::where('id',$roundId)->delete();
       return redirect()->route('points.table');
    }

    public function total($gameId)
    {

        $game=Game::with(['rounds','players'])->where('id',$gameId)->first();
        $rounds=Round::with('points')->where('game_id',$gameId)->get();
        $roundIdArray = Round ::where('game_id', $game -> id) -> pluck('id');
        $players = Player ::where('game_id', $game -> id) -> get();
        $points = Point ::whereIn('round_id', $roundIdArray)-> orderby('round_id','desc')->orderby('player_id','asc')->get();
        return response()->json(['players'=>$players,'rounds'=>$rounds]);

    }

    public function codeInputPage()
    {
        return view('points.input_code');
    }

    public function viewTotal()
    {
        $game=Game::with('rounds')->where('view_token_id',\request()->input('code_id'))->orWhere('edit_token_id',\request()->input('code_id'))->first();
        $roundIdArray = Round ::where('game_id', $game->id) -> pluck('id');
        $players = Player ::where('game_id', $game->id) -> get();
        $points = Point ::whereIn('round_id', $roundIdArray) -> get();
        return view('points.points_table', compact('players', 'points','game','roundIdArray'));

    }
}
