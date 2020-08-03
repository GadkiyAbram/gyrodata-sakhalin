<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Items', function (Blueprint $table) {
            $table->bigIncrements('Id');
            $table->string('Item');
            $table->string('Asset');
            $table->string('Arrived')->nullable();
            $table->string('Invoice')->nullable();
            $table->string('CCD')->nullable();
            $table->string('PositionCCD')->nullable();
            $table->string('ItemStatus')->nullable();
            $table->string('Box')->nullable();
            $table->string('Container')->nullable();
            $table->string('image')->nullable();
            $table->string('Comment')->nullable();

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
        Schema::dropIfExists('items');
    }
}
