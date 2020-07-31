<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('number_of_players');
            $table->integer('winner_unseen_points')->default('10');
            $table->integer('winner_seen_points')->default('3');
            $table->integer('winner_dubli_unseen_points');
            $table->integer('winner_dubli_seen_points');
            $table->string('view_token_id');
            $table->string('edit_token_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
