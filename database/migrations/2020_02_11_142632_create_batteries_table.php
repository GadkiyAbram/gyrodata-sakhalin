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
        Schema::create('Batteries', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('BatteryCondition');
            $table->string('serialOne')->nullable();
            $table->string('serialTwo')->nullable();
            $table->string('serialThr')->nullable();
            $table->string('CCD')->nullable();
            $table->string('Invoice')->nullable();
            $table->string('BatteryStatus')->nullable();
            $table->date('Arrived')->nullable();
            $table->string('Container')->nullable();
            $table->text('Comment')->nullable();
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
        Schema::dropIfExists('batteries');
    }
}
