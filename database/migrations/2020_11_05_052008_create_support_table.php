<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support', function (Blueprint $table) {
            $table->integer('support_num',4);
            $table->string('mail', 30);
            $table->string('support_mail', 30);
            $table->date('day');
            $table->text('support_text');
            $table->timestamps();
            $table->foreign('mail')->references('mail')->on('generalusers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support');
    }
}
