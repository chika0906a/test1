<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipedetails', function (Blueprint $table) {
            $table->char('recipe',5);
            $table->char('ingredients_id',5);
            $table->integer('quantity');
            $table->primary(['recipe','ingredients_id']);
            $table->foreign('recipe')->references('recipe')->on('recipetitle'); 
            $table->foreign('ingredients_id')->references('ingredients_id')->on('ingredients');
            $table->unique(['recipe', 'ingredients_id'],'uq_recipes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipedetails');
    }
}
