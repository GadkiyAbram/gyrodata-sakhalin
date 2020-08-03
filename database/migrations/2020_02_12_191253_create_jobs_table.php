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
        Schema::create('Jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('JobNumber')->unique();
            $table->unsignedBigInteger('client_id')->nullable()->index();
            $table->unsignedBigInteger('gdp_id')->nullable()->index();
            $table->unsignedBigInteger('modem_id')->nullable()->index();
            $table->string('ModemVersion')->nullable();
            $table->unsignedBigInteger('bullplug_id')->nullable()->index();
            $table->float('CirculationHours')->nullable();
            $table->unsignedBigInteger('battery_id')->nullable()->index();
            $table->string('MaxTemp');
            $table->unsignedBigInteger('eng_one')->nullable()->index();
            $table->unsignedBigInteger('eng_two')->nullable()->index();
            $table->date('eng_one_arrived')->nullable();
            $table->date('eng_two_arrived')->nullable();
            $table->date('eng_one_left')->nullable();
            $table->date('eng_two_left')->nullable();
            $table->date('Container')->nullable();
            $table->date('ContainerArrived')->nullable();
            $table->date('ContainerLeft')->nullable();
            $table->date('Rig')->nullable();
            $table->date('Issues')->nullable();
            $table->string('Comment')->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('Id')->on('Clients');

            $table->foreign('gdp_id')->references('Id')->on('Items');
            $table->foreign('modem_id')->references('Id')->on('Items');
            $table->foreign('bullplug_id')->references('Id')->on('Items');

            $table->foreign('battery_id')->references('Id')->on('Batteries');
            $table->foreign('eng_one')->references('Id')->on('Engineers');
            $table->foreign('eng_two')->references('Id')->on('Engineers');
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
