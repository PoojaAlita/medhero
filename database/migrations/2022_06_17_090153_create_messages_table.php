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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->references('id')->on('user_messages');
            $table->string('message');
            $table->boolean('message_type')->comment('0 for text 1 for document')->default(0);
            $table->boolean('message_status')->comment('0 for unseen 1 for seen')->default(0);
            $table->boolean('status')->comment('1 for active 0 for inactive')->default(1);
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
        Schema::dropIfExists('messages');
    }
};
