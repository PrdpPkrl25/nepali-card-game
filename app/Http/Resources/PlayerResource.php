<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $game=$this->whenLoaded('game');
        return [
            'id'=>$this->id,
            'game'=> new GameResource($game),
        ];
    }
}
