<?php

namespace App\Http\Controllers;

use App\Model\Player;
use App\Model\Round;
use App\Point;
use Illuminate\Http\Request;

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
        $game=session()->get('game');
        $players=Player::with('game')->get();
        return view('rounds.add_round_result',compact('game','players'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $game=session()->get('game');
       $round=Round::create(['game_id'=>$game->id]);
       $winner=$request->winner;
       $sumAllPoints=array_sum($request->all()['points']);
      foreach ($request->all()['points'] as $key=>$value){
          if($request->all()['seen'][$key]=='on'){

          }
          else{
              if($request->all()['dubli'][$winner]=='on'){
                  $pointSecured=$sumAllPoints+$game->dubli_winner_points_per_unseen;
                  $pointArray=['player_id'=>$key,'round_id'=>$round->id,'point_scored'=>$pointSecured];
              }
              else{
                  $pointSecured=$sumAllPoints+$game->winner_points_per_unseen;
                  $pointArray=['player_id'=>$key,'round_id'=>$round->id,'point_scored'=>$pointSecured];
              }

          }
    }

        //loop all players and add 10 to the sum of point of unseen
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        //
    }
}
