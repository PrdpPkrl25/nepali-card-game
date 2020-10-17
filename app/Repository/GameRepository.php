<?php


namespace App\Repository;





use App\Model\Game;

class GameRepository
{
    public function handleCreate($request){
        $viewTokenId=rand(1000,100000);
        $editTokenId=rand(1000,100000);
        $attr=[
            'number_of_players'=>$request->totalPlayers,
            'rate_per_point'=>$request->ratePerPoint,
            'winner_points_per_seen'=>$request->winnerPointPerSeen,
            'winner_points_per_unseen'=>$request->winnerPointPerUnseen,
            'dubli_winner_points_per_seen'=>$request->dubliWinnerPointPerSeen,
            'dubli_winner_points_per_unseen'=>$request->dubliWinnerPointPerUnseen,
            'view_token_id'=>$viewTokenId,
            'edit_token_id'=>$editTokenId
        ];
        $game=Game::create($attr);
        session()->put('game',$game);
        return $game;
    }

}
