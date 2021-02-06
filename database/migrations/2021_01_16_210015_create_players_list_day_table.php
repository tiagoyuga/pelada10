<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersListDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_list_day', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('games_day_id')->unsigned();
            $table->foreign('games_day_id')->references('id')->on('games_days');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('order');#ordem de chegada
            $table->boolean('active')->default(true);#campo para monitorar caso o jogador precise se ausentar
            $table->integer('goals')->default(0);#quantidade de gols feito no dia do jogo

            $table->boolean('payment')->default(false);#controlar quem já pagou ou não

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
        Schema::dropIfExists('players_list_day');
    }
}
