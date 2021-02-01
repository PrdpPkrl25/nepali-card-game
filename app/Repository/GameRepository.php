<?php


namespace App\Repository;





use App\Http\Requests\StoreGamePost;
use App\Model\Game;

class GameRepository
{
    public function handleCreate($request){
        $viewTokenId=rand(1000,100000);
        $editTokenId=rand(1000,100000);
        $game=Game::create($request->all()+['view_token_id'=>$viewTokenId, 'edit_token_id'=>$editTokenId]);
        session()->put('game',$game);
        return $game;
    }

}
