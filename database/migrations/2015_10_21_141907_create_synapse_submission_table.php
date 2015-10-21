<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSynapseSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('synapse_submission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('synapse_id')->unsigned()->index();
            $table->foreign('synapse_id')->references('id')->on('synapses')->onDelete('cascade');
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
        Schema::drop('synapse_submission');
    }
}
