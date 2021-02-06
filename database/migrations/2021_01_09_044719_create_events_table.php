<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('number')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('city_name')->nullable();

            $table->string('lat')->nullable();
            $table->string('long')->nullable();

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
        Schema::dropIfExists('events');
    }
}
