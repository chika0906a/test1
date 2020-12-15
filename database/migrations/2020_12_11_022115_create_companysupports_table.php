<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanysupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companysupports', function (Blueprint $table) {
            $table->integer('support_num',4);
            $table->string('mail', 30);
            $table->string('support_mail', 30);
            $table->date('day');
            $table->text('support_text');
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
        Schema::dropIfExists('companysupports');
    }
}
