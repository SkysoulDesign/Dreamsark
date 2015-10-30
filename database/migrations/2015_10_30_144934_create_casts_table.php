<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casts', function (Blueprint $table) {

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('salary');
            $table->string('description');

            $table->integer('position_id')->unsigned()->index();
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('casts');
    }
}
