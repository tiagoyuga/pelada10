<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');

            $table->boolean('is_admin')->default(false);
            $table->dateTime('expiration_date')->nullable();

            $table->integer('owner_id')->unsigned()->nullable();
            $table->foreign('owner_id')->references('id')->on('users');

            $table->integer('updated_user_id')->unsigned()->nullable();#quem deu permissao de admin
            $table->foreign('updated_user_id')->references('id')->on('users');

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
        Schema::dropIfExists('events_user');
    }
}
