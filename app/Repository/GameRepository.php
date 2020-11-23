<?php


namespace App\Repository;





use App\Model\Game;

class GameRepository
{
    public function handleCreate($request){
        $viewTokenId=rand(1000,100000);
        $editTokenId=rand(1000,100000);
        $attr=[
            'number_of_players'=>$request->input['number_of_players'],
            'rate_per_point'=>$request->input['rate_per_point'],
            'winner_points_per_seen'=>$request->input['winner_points_per_seen'],
            'winner_points_per_unseen'=>$request->input['winner_points_per_unseen'],
            'dubli_winner_points_per_seen'=>$request->input['dubli_winner_points_per_seen'],
            'dubli_winner_points_per_unseen'=>$request->input['dubli_winner_points_per_unseen'],
            'view_token_id'=>$viewTokenId,
            'edit_token_id'=>$editTokenId
        ];
        $game=Game::create($attr);
        session()->put('game',$game);
        return $game;
    }

}
