<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alarms', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('tstamp');
            $table->string('tag_name');
            $table->integer('value');
            $table->string('formula');
            $table->integer('sp');
            $table->string('text');
            $table->integer('created_by');
            $table->integer('status');
            $table->datetime('acknowledge_tstamp');
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
        Schema::dropIfExists('alarms');
    }
}
