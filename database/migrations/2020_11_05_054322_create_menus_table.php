<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->string('mail', 30);
            $table->date('day');
            $table->char('recipe', 5);
            $table->primary(['mail', 'day']);
            $table->timestamps();
            $table->foreign('mail')->references('mail')->on('generalusers');
            $table->foreign('recipe')->references('recipe')->on('recipetitle');
            $table->unique(['mail', 'recipe'], 'uq_menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
