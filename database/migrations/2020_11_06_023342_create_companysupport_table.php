<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanysupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companysupport', function (Blueprint $table) {
            $table->integer('support_num',4);
            $table->string('company_mail', 30);
            $table->string('support_mail', 30);
            $table->date('day');
            $table->text('support_text');
            $table->timestamps();
            $table->foreign('company_mail')->references('company_mail')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companysupport');
    }
}
