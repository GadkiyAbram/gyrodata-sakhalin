<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jobNumber')->unique();
            $table->string('toolNumber')->nullable();
            $table->string('modemNumber')->nullable();
            $table->string('bbpNumber')->nullable();
            $table->string('firstEng')->nullable();
            $table->string('secondEng')->nullable();
            $table->date('eng1ArrRig')->nullable();
            $table->date('eng2ArrRig')->nullable();
            $table->date('eng1DepRig')->nullable();
            $table->date('eng2DepRig')->nullable();
            $table->date('container')->nullable();
            $table->date('containerArrRig')->nullable();
            $table->date('containerDepRig')->nullable();
            $table->float('toolCircHrs')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
