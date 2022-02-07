<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_results', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('form_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onUpdate('CASCADE');
            $table->foreign('form_id')->references('id')->on('forms')->onUpdate('CASCADE')->onUpdate('CASCADE');

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
        Schema::dropIfExists('form_results');
    }
}
