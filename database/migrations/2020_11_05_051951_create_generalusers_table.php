<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalusers', function (Blueprint $table) {
            $table->string('mail',30)->primary();
            $table->string('password',20);
            $table->string('gender',6);
            $table->integer('date');
            $table->char('area_id',5);
            $table->char('station_id',5);
            $table->integer('people_ind');
            $table->string('nickname',20);
            $table->timestamps();
            $table->foreign('area_id')->references('area_id')->on('areas');
            $table->foreign('station_id')->references('station_id')->on('stations');
            $table->foreign('people_ind')->references('people_ind')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generalusers');
    
    }
}
