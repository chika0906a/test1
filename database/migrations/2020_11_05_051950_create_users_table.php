<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('gender',6)->nullable();
            $table->date('date')->nullable();
            $table->char('area_id',5)->nullable();
            $table->char('station_id',5)->nullable();
            $table->integer('people_ind')->nullable();
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
        Schema::dropIfExists('users');
    }
}
