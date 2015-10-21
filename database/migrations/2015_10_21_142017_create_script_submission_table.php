<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScriptSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('script_submission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('script_id')->unsigned()->index();
            $table->foreign('script_id')->references('id')->on('scripts')->onDelete('cascade');
            $table->integer('submission_id')->unsigned()->index();
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
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
        Schema::drop('script_submission');
    }
}
