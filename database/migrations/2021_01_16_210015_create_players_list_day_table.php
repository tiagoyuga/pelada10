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
            $table->increments('id');

            $table->integer('games_day_id')->unsigned();
            $table->foreign('games_day_id')->references('id')->on('games_days');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('order');#ordem de chegada
            $table->boolean('active')->default(true);#campo para monitorar caso o jogador precise se ausentar
            $table->integer('goals')->default(0);#quantidade de gols feito no dia do jogo

            $table->boolean('payment')->default(false);#controlar quem já pagou ou não

            $table->integer('user_creator_id')->unsigned()->nullable();
            $table->foreign('user_creator_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('user_updater_id')->unsigned()->nullable();
            $table->foreign('user_updater_id')->references('id')->on('users')->onDelete('restrict');
            $table->integer('user_eraser_id')->unsigned()->nullable();
            $table->foreign('user_eraser_id')->references('id')->on('users')->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();
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
