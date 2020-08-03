<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GameDetail extends Mailable
{
    use Queueable, SerializesModels;
    protected $game;

    /**
     * Create a new message instance.
     *
     * @param $game
     */
    public function __construct($game)
    {
        $this->game=$game;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.games.detail')
            ->with([
                'game_url'=>url('view/points-table').'?code_id='.$this->game->view_token_id,


            ]);
    }
}
