<?php


namespace App\Repository;


use App\Model\Game;
use App\Model\Point;
use App\Model\Round;
use Illuminate\Support\Facades\Log;


class PointRepository
{
    function handleStore($request){
        $game = Game::findOrFail($request->gameId);
        $round = Round ::create(['game_id' => $game->id]);
        List($sumAllPoints,$winner,$winnerDubli) = $this->totalPoints($request->input);
        $winnerPoint = 0;
        foreach($request -> input as $player) {
            if($player['winner']) {
                continue;
            }
            if($player['seen']) {
                if($winnerDubli) {
                    if($player['dubli']) {
                        $pointSecured = ($player['point'] * $game -> number_of_players) - ($sumAllPoints);
                        $pointArray = ['player_id' => $player['player_id'], 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1,'dubli'=>1];
                    } else {
                        $pointSecured = ($player['point'] * $game -> number_of_players) - ($sumAllPoints + $game -> dubli_winner_points_per_seen);
                        $pointArray = ['player_id' => $player['player_id'], 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1];
                    }
                } else {
                    if($player['dubli']) {
                        $pointSecured = ($player['point'] * $game -> number_of_players) - ($sumAllPoints);
                        $pointArray = ['player_id' => $player['player_id'], 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1,'dubli'=>1];
                    } else {
                        $pointSecured = ($player['point'] * $game -> number_of_players) - ($sumAllPoints + $game -> winner_points_per_seen);
                        $pointArray = ['player_id' => $player['player_id'], 'round_id' => $round -> id, 'point_scored' => $pointSecured,'seen'=>1];
                    }
                }
            } else {
                if($winnerDubli) {
                    $pointSecured = -1 * ($sumAllPoints + $game -> dubli_winner_points_per_unseen);
                    $pointArray = ['player_id' => $player['player_id'], 'round_id' => $round -> id, 'point_scored' => $pointSecured];
                } else {
                    $pointSecured = -1 * ($sumAllPoints + $game -> winner_points_per_unseen);
                    $pointArray = ['player_id' => $player['player_id'], 'round_id' => $round -> id, 'point_scored' => $pointSecured];
                }

            }

            Point ::create($pointArray);
            $winnerPoint = $winnerPoint + $pointSecured;
        }
        $winnerArray = ['player_id' => $winner, 'round_id' => $round -> id, 'point_scored' => -1*$winnerPoint,'seen'=>1,'dubli'=>$winnerDubli,'winner'=>1];
        Point ::create($winnerArray);
        return $round->id;

    }

    function totalPoints($input){
        $totalPoints=0;
        foreach ($input as $data){
            $totalPoints=$totalPoints+$data['point'];
            if($data['winner']){
                $winnerDubli=$data['dubli'];
                $winner=$data['player_id'];
            }
        }
        return [$totalPoints,$winner,$winnerDubli];
    }

}
