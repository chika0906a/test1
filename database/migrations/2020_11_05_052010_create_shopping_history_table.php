<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_history', function (Blueprint $table) {
            $table->string('mail', 30);
            $table->date('day');
            $table->char('ingredients_id', 5);
            $table->integer("quantity");
            $table->primary(['mail', 'ingredients_id','day']);
            $table->foreign('mail')->references('mail')->on('generalusers');
            $table->foreign('ingredients_id')->references('ingredients_id')->on('ingredients');
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
        Schema::dropIfExists('shopping_history');
    }
}
