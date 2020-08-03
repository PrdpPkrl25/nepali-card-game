<?php

use App\Model\Point;


     function totalPoint($roundIdArray,$playerId){
       return Point::whereIn('round_id',$roundIdArray)->where('player_id',$playerId)->sum('point_scored');
    }

    function totalAmount($roundIdArray,$playerId,$game){
        $totalPoint= Point::whereIn('round_id',$roundIdArray)->where('player_id',$playerId)->sum('point_scored');
        return $totalPoint * $game->rate_per_point;

    }




