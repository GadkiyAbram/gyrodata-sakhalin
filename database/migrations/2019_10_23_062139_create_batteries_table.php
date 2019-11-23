<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batteries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serialOne');
            $table->string('serialTwo')->nullable();
            $table->string('serialThree')->nullable();
            $table->unsignedBigInteger('job_id')->index()->nullable();

            $table->date('date')->nullable();
            $table->integer('condition')->nullable();
            $table->string('invoice')->nullable();
            $table->string('ccd')->nullable();
            $table->string('job_assigned')->nullable();
            $table->text('comment')->nullable();
            $table->string('container')->nullable();
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batteries');
    }
}
