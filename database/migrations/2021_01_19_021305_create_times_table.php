<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('match_id')->unsigned();
            $table->foreign('match_id')->references('id')->on('matches');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('team_id')->nullable();
            $table->integer('order')->nullable();#numeracao do time, time1,2,3,4..

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
        Schema::dropIfExists('times');
    }
}
