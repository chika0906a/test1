<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('mail',30);
            $table->char('ingredients_id',5);
            $table->integer('quantity');
            $table->primary(['mail', 'ingredients_id']);
            $table->foreign('mail')->references('mail')->on('generalusers'); 
            $table->foreign('ingredients_id')->references('ingredients_id')->on('ingredients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
