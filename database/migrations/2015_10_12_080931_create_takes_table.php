<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('takes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('script_id')->unsigned()->index();
            $table->foreign('script_id')->references('id')->on('scripts')->onDelete('cascade');
            $table->string('title');
            $table->string('length');
            $table->string('location');
            $table->string('shot');
            $table->longText('description');
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
        Schema::drop('takes');
    }
}
