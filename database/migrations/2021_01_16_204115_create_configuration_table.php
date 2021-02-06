<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');

            $table->integer('players')->unsigned();#quantidade de atletas por time
            $table->time('game_duration')->nullable();

            $table->string('team1_name')->default('Team 1');
            $table->string('team2_name')->default('Team 2');

            $table->integer('max_players_list_limit')->unsigned()->nullable();#quantidade máxima de atletas permitida na lista.
            $table->integer('count_players_leave_both')->unsigned()->nullable();#quantidade de atletas para sair os 2 times caso empate

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
        Schema::dropIfExists('configuration');
    }
}
