<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tool_type');
            $table->string('tool_number');
            $table->date('tool_arrived')->nullable();
            $table->date('tool_demob')->nullable();
            $table->string('tool_invoice')->nullable();
            $table->string('tool_ccd')->nullable();
            $table->text('tool_desc_rus')->nullable();
            $table->string('tool_ccd_pos')->nullable();
            $table->string('tool_location')->nullable();
            $table->float('tool_circHrs')->nullable()->default(0);
            $table->date('tool_last_rt')->nullable();
            $table->string('tool_comment')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('tools');
    }
}
