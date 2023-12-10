<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('u_id');
            $table->foreign('u_id')->references('id')->on('users');
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->text('description');
            $table->boolean('status')->default('1')->comment('1 for active, 0 for in active');
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
        Schema::dropIfExists('events');
    }
};
