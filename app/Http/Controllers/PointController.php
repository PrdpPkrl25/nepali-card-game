<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePointsPost;
use App\Model\Game;
use App\Model\Player;
use App\Model\Point;
use App\Model\Round;
use App\Repository\PointRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PointController extends Controller
{
    private $pointRepository;

    public function __construct(PointRepository $pointRepository)
    {
        $this->pointRepository = $pointRepository;
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
        $game = session() -> get('game');
        $players = Player ::with('game') -> where('game_id', $game -> id) -> get();
        return view('rounds.add_round_result', compact('game', 'players'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $roundId=$this->pointRepository->handleStore($request);
        return response()->json($roundId);

    }



    /**
     * Display the specified resource.
     *
     * @param $roundId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($roundId)
    {

        $points=Point::with('player')->where('round_id',$roundId)->orderBy('player_id')->get();
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

    public function playerPoint(Request $request,$id){

        $roundIdArray=$request->input('roundIdArray');
        $totalPoint=totalPoint($roundIdArray,$id);
        return response()->json($totalPoint);
    }

    public function total($gameId)
    {
        $game=Game::with(['rounds','players'])->where('id',$gameId)->first();
        $rounds=Round::with('points')->where('game_id',$gameId)->get();
        $roundIdArray = Round ::where('game_id', $game -> id) -> pluck('id');
        $players = Player ::where('game_id', $game -> id) -> get();
        return response()->json(['players'=>$players,'rounds'=>$rounds,'roundIdArray'=>$roundIdArray]);

    }

    public function codeInputPage()
    {
        return view('points.input_code');
    }

    public function viewTotal()
    {
        $game=Game::with('rounds')->where('view_token_id',\request()->input('code'))->orWhere('edit_token_id',\request()->input('code'))->first();
        $editStatus=$game->edit_token_id==\request()->input('code')?1:0;
        return response()->json(['gameId'=>$game->id,'editStatus'=>$editStatus]);

    }
}
