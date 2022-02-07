<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subforms', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("form_id");
            $table->timestamps();
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subforms');
    }
}
