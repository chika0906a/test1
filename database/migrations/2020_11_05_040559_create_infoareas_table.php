<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infoareas', function (Blueprint $table) {
            $table->integer('info_num');
            $table->char('station_id', 5);
            $table->primary(['info_num', 'station_id']);
            $table->foreign('info_num')->references('info_num')->on('info');
            $table->foreign('station_id')->references('station_id')->on('stations');
            $table->unique(['info_num', 'station_id'], 'uq_infoareas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infoarea');
    }
}
