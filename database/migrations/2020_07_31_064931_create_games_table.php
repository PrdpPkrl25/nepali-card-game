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
            $table->integer('rate_per_point');
            $table->integer('winner_points_per_seen')->default('10');
            $table->integer('winner_points_per_unseen')->default('3');
            $table->integer('dubli_winner_points_per_seen')->default('10');;
            $table->integer('dubli_winner_points_per_unseen')->default('5');;
            $table->string('view_token_id')->nullable();
            $table->string('edit_token_id')->nullable();
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
