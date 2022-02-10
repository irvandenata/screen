<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subevents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('event_id');
            $table->string('start_regist');
            $table->string('end_regist');
            $table->boolean('status')->default(0);
            $table->text('slug');
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subevents');
    }
}
