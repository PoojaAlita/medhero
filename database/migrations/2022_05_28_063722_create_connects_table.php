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
        Schema::create('connects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users');
            $table->unsignedBigInteger('to_id');
            $table->foreign('to_id')->references('id')->on('users');
            $table->boolean('status')->default('0')->comment('0 for pending, 1 for in accept, 2 for canceled')->nullable();
            $table->boolean('connect_status')->default('1')->comment('0 for delete, 1 for in active, 2 for block')->nullable();
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
        Schema::dropIfExists('connects');
    }
};
