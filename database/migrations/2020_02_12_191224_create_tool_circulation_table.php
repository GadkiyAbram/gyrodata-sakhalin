<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolCirculationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tool_circulation', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->unsignedBigInteger('item_id')->index();
            $table->string('item_description');
            $table->string('item_asset');
            $table->float('Circ_Hours');
            $table->timestamps();

            $table->foreign('item_id')->references('Id')->on('Items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tool_circulation');
    }
}
